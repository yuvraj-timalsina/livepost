<?php
    
    namespace Database\Seeders;
    
    use App\Models\User;
    use Illuminate\Database\Seeder;
    use App\Http\Traits\TruncateTable;
    use App\Http\Traits\DisableForeignKeys;
    
    class UserSeeder extends Seeder
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
            $this->truncateTable('users');
            User::factory(10)->create();
            $this->enableForeignKeys();
        }
    }
