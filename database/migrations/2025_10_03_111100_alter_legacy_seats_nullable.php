<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('seats') && Schema::hasColumn('seats', 'theatre_no')) {
            try {
                DB::statement('ALTER TABLE seats MODIFY theatre_no INT NULL');
            } catch (Throwable $e) {
                // ignore if dbal not allowed or already nullable
            }
        }
    }

    public function down(): void
    {
        // no-op
    }
};
