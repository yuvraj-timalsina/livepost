<?php

    namespace Database\Seeders;

    use App\Helpers\Factory\FactoryHelper;
    use App\Models\Post;
    use App\Models\User;
    use App\Traits\DisableForeignKeys;
    use App\Traits\TruncateTable;
    use Illuminate\Database\Seeder;

    class PostSeeder extends Seeder
    {
        use TruncateTable;
        use DisableForeignKeys;

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() : void
        {
            $this->disableForeignKeys();
            $this->truncateTable('posts');
            $posts = Post::factory(200)
//                ->has(Comment::factory(3), 'comments')
//                ->untitled()
                ->create();
            $posts->each(static function (Post $post) {
                $post->users()->sync(FactoryHelper::getRandomModelId(User::class));
            });
            $this->enableForeignKeys();
        }
    }
