<?php

    namespace Tests\Unit;

    use App\Exceptions\GeneralJsonException;
    use App\Models\User;
    use App\Repositories\UserRepository;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class UserRepositoryTest extends TestCase
    {
        use RefreshDatabase;

        public function test_create() : void
        {
            // 1. Define the goal
            // test if create() will actually create a record in the DB

            // 2. Replicate the env / restriction
            $repository = $this->app->make(UserRepository::class);

            // 3. define the source of truth
            $payload = [
                'name' => 'John Doe',
                'email' => 'john@doe.com',
                'password' => 'secret',
            ];

            // 4. compare the result
            $result = $repository->create($payload);

            $this->assertSame($payload['name'], $result->name, 'User created does not have the same name.');
        }

        public function test_update() : void
        {
            // Goal: make sure we can update a user using the update method

            // env
            $repository = $this->app->make(UserRepository::class);

            $dummyUser = User::factory(1)->create()->first();

            // source of truth
            $payload = [
                'name' => 'John Doe',
            ];

            // compare
            $updated = $repository->update($dummyUser, $payload);
            $this->assertSame($payload['name'], $updated->name, 'User updated does not have the same name.');
        }

        public function test_delete_will_throw_exception_when_delete_user_that_doesnt_exist() : void
        {
            // env
            $repository = $this->app->make(UserRepository::class);
            $dummy = User::factory(1)->make()->first();

            $this->expectException(GeneralJsonException::class);
            $deleted = $repository->forceDelete($dummy);
        }

        public function test_delete() : void
        {
            // Goal: test if forceDelete() is working

            // env
            $repository = $this->app->make(UserRepository::class);
            $dummy = User::factory(1)->create()->first();

            // compare
            $deleted = $repository->forceDelete($dummy);

            // verify if it is deleted
            $found = User::query()->find($dummy->id);

            $this->assertNull($found, 'User is not deleted');
        }
    }
