<?php
    namespace App\Traits;
    use Illuminate\Support\Facades\DB;

    trait TruncateTable
    {
        public function truncateTable($table): void
        {
            DB::table($table)->truncate();
        }
    }