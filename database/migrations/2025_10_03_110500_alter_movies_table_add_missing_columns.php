<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('movies')) {
            Schema::table('movies', function (Blueprint $table) {
                if (!Schema::hasColumn('movies', 'title')) {
                    $table->string('title')->after('id');
                }
                if (!Schema::hasColumn('movies', 'language')) {
                    $table->string('language')->default('TH/EN')->nullable();
                }
                if (!Schema::hasColumn('movies', 'genre')) {
                    $table->string('genre')->nullable();
                }
                if (!Schema::hasColumn('movies', 'description')) {
                    $table->text('description')->nullable();
                }
                if (!Schema::hasColumn('movies', 'poster_url')) {
                    $table->string('poster_url')->nullable();
                }
                if (!Schema::hasColumn('movies', 'created_at')) {
                    $table->timestamps();
                }
            });
        }
    }

    public function down(): void
    {
        // no-op
    }
};
