<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\UpdatePostRequest;
    use App\Http\Resources\PostResource;
    use App\Models\Post;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\DB;

    class PostController extends Controller
    {
        public function index()
        {
            $posts = Post::query()->get();

            return PostResource::collection($posts);
        }

        public function store(Request $request) : Response
        {
            $created = DB::transaction(static function () use ($request) {
                $created = Post::query()->create([
                    'title' => $request->title,
                    'body' => $request->body,
                ]);
                $created->users()->sync($request->user_ids);

                return $created;
            });

            return new PostResource($created);
        }

        public function show(Post $post) : PostResource
        {
            return new PostResource($post);
        }

        public function update(UpdatePostRequest $request, Post $post) : Response
        {
            //            $post -> update($request -> only(['title', 'body']));
            $updated = $post->update([
                'title' => $request->title ?? $post->title,
                'body' => $request->body ?? $post->body,
            ]);
            if (!$updated) {
                return response([
                    'error' => 'Post not updated!',
                ], 400);
            }

            return new PostResource($post);
        }

        public function destroy(Post $post) : ?Response
        {
            $deleted = $post->forceDelete();
            if (!$deleted) {
                return response([
                    'error' => 'Post not deleted!',
                ], 400);
            }

            return response([
                'data' => 'Post deleted!',
            ]);
        }
    }
