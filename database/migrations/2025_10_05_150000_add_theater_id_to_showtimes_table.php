<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('showtimes', function (Blueprint $table) {
            if (!Schema::hasColumn('showtimes', 'theater_id')) {
                $table->foreignId('theater_id')->after('movie_id')->nullable()->constrained('theaters')->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('showtimes', function (Blueprint $table) {
            if (Schema::hasColumn('showtimes', 'theater_id')) {
                $table->dropForeign(['theater_id']);
                $table->dropColumn('theater_id');
            }
        });
    }
};
