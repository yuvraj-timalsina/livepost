<?php

    namespace App\Http\Controllers;

    use App\Http\Resources\PostResource;
    use App\Models\Post;
    use App\Repositories\PostRepository;
    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
    use Illuminate\Http\Response;

    class PostController extends Controller
    {
        public function index(Request $request) : AnonymousResourceCollection
        {
            $pageSize = $request->page_size ?? 20;
            $posts = Post::query()->paginate($pageSize);

            return PostResource::collection($posts);
        }

        public function store(Request $request, PostRepository $repository) : PostResource
        {
            $created = $repository->create($request->only(['title', 'body', 'user_ids']));

            return new PostResource($created);
        }

        public function show(Post $post) : PostResource
        {
            return new PostResource($post);
        }

        public function update(Request $request, Post $post, PostRepository $repository) : PostResource
        {
            $post = $repository->update($post, $request->only([
                'title',
                'body',
                'user_ids']));

            return new PostResource($post);
        }

        public function destroy(Post $post, PostRepository $repository) : Response
        {
            $repository->forceDelete($post);

            return response([
                'data' => 'Post deleted!',
            ]);
        }
    }
