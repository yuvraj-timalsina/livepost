<?php
    
    namespace Database\Seeders;
    
    use App\Models\Comment;
    use Illuminate\Database\Seeder;
    use App\Http\Traits\TruncateTable;
    use App\Http\Traits\DisableForeignKeys;
    
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
            Comment::factory(10)->create();
            $this->enableForeignKeys();
        }
    }
