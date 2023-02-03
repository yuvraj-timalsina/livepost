<?php

    namespace Tests\Unit;

    use App\Exceptions\GeneralJsonException;
    use App\Models\Post;
    use App\Repositories\PostRepository;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class PostRepositoryTest extends TestCase
    {
        use RefreshDatabase;

        public function test_create() : void
        {
            // 1. Define the goal
            // test if create() will actually create a record in the DB

            // 2. Replicate the env / restriction
            $repository = $this->app->make(PostRepository::class);

            // 3. define the source of truth
            $payload = [
                'title' => 'Test Title',
                'body' => []
            ];

            // 4. compare the result
            $result = $repository->create($payload);

            $this->assertSame($payload['title'], $result->title, 'Post created does not have the same title.');
        }

        public function test_update() : void
        {
            // Goal: make sure we can update a post using the update method

            // env
            $repository = $this->app->make(PostRepository::class);

            $dummyPost = Post::factory(1)->create()[0];

            // source of truth
            $payload = [
                'title' => 'abc123',
            ];

            // compare
            $updated = $repository->update($dummyPost, $payload);
            $this->assertSame($payload['title'], $updated->title, 'Post updated does not have the same title.');
        }

        public function test_delete_will_throw_exception_when_delete_post_that_doesnt_exist() : void
        {
            // env
            $repository = $this->app->make(PostRepository::class);
            $dummy = Post::factory(1)->make()->first();

            $this->expectException(GeneralJsonException::class);
            $deleted = $repository->forceDelete($dummy);
        }

        public function test_delete() : void
        {
            // Goal: test if forceDelete() is working

            // env
            $repository = $this->app->make(PostRepository::class);
            $dummy = Post::factory(1)->create()->first();

            // compare
            $deleted = $repository->forceDelete($dummy);

            // verify if it is deleted
            $found = Post::query()->find($dummy->id);

            $this->assertNull($found, 'Post is not deleted');
        }
    }
