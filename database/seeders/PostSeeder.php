<?php
    
    namespace Database\Seeders;
    
    use App\Models\Post;
    use Illuminate\Database\Seeder;
    use App\Http\Traits\TruncateTable;
    use App\Http\Traits\DisableForeignKeys;
    
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
            Post::factory(3)->untitled()->create();
            $this->enableForeignKeys();
        }
    }
