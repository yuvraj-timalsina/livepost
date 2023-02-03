<?php

    namespace Tests\Unit;

    use App\Models\Post;
    use App\Repositories\PostRepository;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class PostRepositoryTest extends TestCase
    {
        use RefreshDatabase;

        public function test_create()
        {
            $repository = $this->app->make(PostRepository::class);

            $payload = [
                'title' => 'Test Title',
                'body' => [],
            ];

            $result = $repository->create($payload);

            $this->assertSame($payload['title'], $result->title, 'Post created does not match the payload!');
        }

        public function test_update()
        {
            $repository = $this->app->make(PostRepository::class);

            $dummyPost = Post::factory(1)->create()[0];

            $payload = [
                'title' => 'Test Title'
            ];

            $updated = $repository->update($dummyPost, $payload);

            $this->assertSame($payload['title'], $updated->title, 'Post updated does not match the payload!');
        }

        public function test_delete()
        {
            $repository = $this->app->make(PostRepository::class);

            $dummyPost = Post::factory(1)->create()->first();

            $deleted = $repository->forceDelete($dummyPost);

            $found = Post::query()->find($dummyPost->id);

            $this->assertNull($found, 'Post was not deleted!');
        }
    }
