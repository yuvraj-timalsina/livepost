<?php

    namespace App\Repositories;

    use App\Events\Models\Post\PostCreated;
    use App\Exceptions\GeneralJsonException;
    use App\Models\Post;
    use Illuminate\Support\Facades\DB;

    class PostRepository extends BaseRepository
    {
        public function create(array $attributes)
        {
            return DB::transaction(static function () use ($attributes) {
                $created = Post::query()->create([
                    'title' => data_get($attributes, 'title', 'Untitled'),
                    'body' => data_get($attributes, 'body'),
                ]);

                throw_if(!$created, new GeneralJsonException('Failed to create post'));

                if ($userIds = data_get($attributes, 'user_ids')) {
                    $created->users()->sync($userIds);
                }
                event(new PostCreated($created));

                return $created;
            });
        }

        public function update($post, array $attributes)
        {
            return DB::transaction(static function () use ($post, $attributes) {
                $updated = $post->update([
                    'title' => data_get($attributes, 'title', $post->title),
                    'body' => data_get($attributes, 'body', $post->body),
                ]);

                throw_if(!$updated, new GeneralJsonException('Failed to update post'));

                if ($userIds = data_get($attributes, 'user_ids')) {
                    $post->users()->sync($userIds);
                }
                event(new PostUpdated($post));

                return $post;
            });
        }

        public function forceDelete($post)
        {
            return DB::transaction(static function () use ($post) {
                $deleted = $post->forceDelete();

                throw_if(!$deleted, new GeneralJsonException('Failed to delete post'));
                event(new PostDeleted($post));

                return $deleted;
            });
        }
    }
