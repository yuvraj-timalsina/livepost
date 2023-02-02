<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreCommentRequest;
    use App\Http\Requests\UpdateCommentRequest;
    use App\Http\Resources\CommentResource;
    use App\Models\Comment;

    class CommentController extends Controller
    {
        public function index()
        {
            $pageSize = request()->page_size ?? 20;
            $comments = Comment::paginate($pageSize);

            return CommentResource::collection($comments);
        }

        public function store(StoreCommentRequest $request)
        {
            $created = Comment::create([
                'body' => $request->body,
                'post_id' => $request->post_id,
                'user_id' => $request->user_id,
            ]);

            return new CommentResource($created);
        }

        public function show(Comment $comment) : CommentResource
        {
            return new CommentResource($comment);
        }

        public function update(UpdateCommentRequest $request, Comment $comment)
        {
            $updated = $comment->update([
                'body' => $request->body ?? $comment->body,
            ]);
            if (!$updated) {
                return response([
                    'error' => 'Comment not updated!',
                ], 400);
            }

            return new CommentResource($comment);
        }

        public function destroy(Comment $comment)
        {
            $deleted = $comment->delete();
            if (!$deleted) {
                return response([
                    'error' => 'Comment not deleted!',
                ], 400);
            }

            return response(null, 204);
        }
    }
