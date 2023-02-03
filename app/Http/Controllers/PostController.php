<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\PostStoreRequest;
    use App\Http\Resources\PostResource;
    use App\Models\Post;
    use App\Repositories\PostRepository;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;

    class PostController extends Controller
    {
        public function index(Request $request)
        {
            $pageSize = $request->page_size ?? 20;
            $posts = Post::query()->paginate($pageSize);

            return PostResource::collection($posts);
        }

        public function store(PostStoreRequest $request, PostRepository $repository)
        {
            $created = $repository->create($request->validate());

            return new PostResource($created);
        }

        public function show(Post $post)
        {
            return new PostResource($post);
        }

        public function update(Request $request, Post $post, PostRepository $repository)
        {
            $post = $repository->update($post, $request->only([
                'title',
                'body',
                'user_ids',
            ]));

            return new PostResource($post);
        }

        public function destroy(Post $post, PostRepository $repository)
        {
            $post = $repository->forceDelete($post);

            return new JsonResponse([
                'data' => 'success'
            ]);
        }
    }
