<?php
    
    namespace Database\Seeders;
    
    use App\Models\Comment;
    use App\Traits\TruncateTable;
    use Illuminate\Database\Seeder;
    use App\Traits\DisableForeignKeys;
    
    class CommentSeeder extends Seeder
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
            $this->truncateTable('comments');
            
            Comment::factory(3)
                //                ->for(Post::factory(1), 'post')
                ->create();
            
            $this->enableForeignKeys();
        }
    }
