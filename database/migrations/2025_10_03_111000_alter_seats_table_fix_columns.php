<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('seats')) {
            Schema::table('seats', function (Blueprint $table) {
                if (!Schema::hasColumn('seats', 'theater_id')) {
                    $table->foreignId('theater_id')->after('id')->nullable();
                }
                if (!Schema::hasColumn('seats', 'row')) {
                    $table->string('row')->nullable();
                }
                if (!Schema::hasColumn('seats', 'number')) {
                    $table->unsignedInteger('number')->default(1);
                }
                if (!Schema::hasColumn('seats', 'type')) {
                    $table->string('type')->default('normal');
                }
                if (!Schema::hasColumn('seats', 'price_delta')) {
                    $table->unsignedInteger('price_delta')->default(0);
                }
            });
            // add FK in a separate statement to avoid issues when column just added
            Schema::table('seats', function (Blueprint $table) {
                try {
                    $table->foreign('theater_id')->references('id')->on('theaters')->cascadeOnDelete();
                } catch (Throwable $e) {
                    // ignore if already exists
                }
            });
        }
    }

    public function down(): void
    {
        // no rollback safety for legacy tables
    }
};
