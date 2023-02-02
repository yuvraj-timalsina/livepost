<?php

    namespace App\Repositories;

    use App\Models\Post;
    use Exception;
    use Illuminate\Support\Facades\DB;

    class PostRepository extends BaseRepository
    {
        public function create(array $attributes)
        {
            return DB::transaction(static function () use ($attributes) {
                $created = Post::query()->create([
                    'title' => data_get($attributes, 'title', 'Untitled'),
                    'body' => data_get($attributes, 'body', 'No body'),
                ]);
                if ($userIds = data_get($attributes, 'user_ids')) {
                    $created->users()->sync($userIds);
                }

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
                if (!$updated) {
                    throw new Exception('Post not updated!');
                }
                if ($userIds = data_get($attributes, 'user_ids')) {
                    $post->users()->sync($userIds);
                }

                return $post;
            });
        }

        public function forceDelete($post)
        {
            return DB::transaction(static function () use ($post) {
                $deleted = $post->forceDelete();
                if (!$deleted) {
                    throw new \Exception('Post not deleted!');
                }

                return $deleted;
            });
        }
    }
