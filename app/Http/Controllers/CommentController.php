<?php

    namespace App\Http\Controllers;

    use App\Http\Resources\CommentResource;
    use App\Models\Comment;
    use App\Repositories\CommentRepository;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;

    class CommentController extends Controller
    {
        public function index(Request $request)
        {
            $comments = Comment::query()->paginate($request->page_size ?? 20);

            return CommentResource::collection($comments);
        }

        public function store(Request $request, CommentRepository $repository)
        {
            $created = $repository->create($request->only([
                'title',
                'body',
                'user_id',
                'post_id',
            ]));

            return new CommentResource($created);
        }

        public function show(Comment $comment)
        {
            return new CommentResource($comment);
        }

        public function update(Request $request, Comment $comment, CommentRepository $repository)
        {
            $comment = $repository->update($comment, $request->only([
                'title',
                'body',
                'user_id',
                'post_id',
            ]));

            return new CommentResource($comment);
        }

        public function destroy(Comment $comment, CommentRepository $repository)
        {
            $deleted = $repository->forceDelete($comment);

            return new JsonResponse([
                'data' => 'success',
            ]);
        }
    }
