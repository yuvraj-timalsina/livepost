<?php
    
    namespace Database\Seeders;
    
    use App\Models\User;
    use App\Traits\TruncateTable;
    use Illuminate\Database\Seeder;
    use App\Traits\DisableForeignKeys;

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
