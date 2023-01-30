<?php
    
    namespace Database\Seeders;
    
    use App\Models\Post;
    use App\Models\User;
    use App\Traits\TruncateTable;
    use Illuminate\Database\Seeder;
    use App\Traits\DisableForeignKeys;
    use App\Helpers\Factory\FactoryHelper;

    class PostSeeder extends Seeder
    {
        use TruncateTable;
        use DisableForeignKeys;
        
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $this->disableForeignKeys();
            $this->truncateTable('posts');
            
            $posts = Post::factory(3)
                //                ->has(Comment::factory(3), 'comments')
                ->untitled()->create();
            
            $posts->each(static function (Post $post) {
                $post->users()->sync(FactoryHelper::getRandomModelId(User::class));
            });
            
            $this->enableForeignKeys();
        }
    }
