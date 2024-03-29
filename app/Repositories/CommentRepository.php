<?php

    namespace App\Repositories;

    use App\Events\Models\Comment\CommentCreated;
    use App\Events\Models\Comment\CommentDeleted;
    use App\Events\Models\Comment\CommentUpdated;
    use App\Exceptions\GeneralJsonException;
    use App\Models\Comment;
    use Illuminate\Support\Facades\DB;

    class CommentRepository extends BaseRepository
    {
        public function create(array $attributes)
        {
            return DB::transaction(static function () use ($attributes) {
                $created = Comment::query()->create([
                    'title' => data_get($attributes, 'title'),
                    'body' => data_get($attributes, 'body'),
                    'user_id' => data_get($attributes, 'user_id'),
                    'post_id' => data_get($attributes, 'post_id'),
                ]);

                throw_if(!$created, new GeneralJsonException('Failed to create comment'));
                event(new CommentCreated($created));

                return $created;
            });
        }

        public function update($comment, array $attributes)
        {
            return DB::transaction(static function () use ($comment, $attributes) {
                $updated = $comment->update([
                    'title' => data_get($attributes, 'title', $comment->title),
                    'body' => data_get($attributes, 'body', $comment->body),
                    'user_id' => data_get($attributes, 'user_id', $comment->user_id),
                    'post_id' => data_get($attributes, 'post_id', $comment->post_id),
                ]);

                throw_if(!$updated, new GeneralJsonException('Failed to update comment'));
                event(new CommentUpdated($comment));

                return $comment;
            });
        }

        public function forceDelete($comment)
        {
            return DB::transaction(static function () use ($comment) {
                $deleted = $comment->forceDelete();

                throw_if(!$deleted, new GeneralJsonException('Failed to delete comment'));
                event(new CommentDeleted($comment));

                return $deleted;
            });
        }
    }
