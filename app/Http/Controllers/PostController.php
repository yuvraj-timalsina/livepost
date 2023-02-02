<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\UpdatePostRequest;
    use App\Models\Post;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\DB;

    class PostController extends Controller
    {
        public function index() : Response
        {
            $posts = Post::query()->get();

            return response([
                'posts' => $posts,
            ]);
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

            return response([
                'data' => $created,
            ]);
        }

        public function show(Post $post) : ?Response
        {
            return response([
                'post' => $post,
            ]);
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

            return response([
                'post' => $post,
            ]);
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
