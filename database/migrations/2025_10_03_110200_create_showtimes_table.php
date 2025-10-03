<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('showtimes')) {
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained('movies')->cascadeOnDelete();
            $table->foreignId('theater_id')->constrained('theaters')->cascadeOnDelete();
            $table->date('show_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('base_price')->default(100);
            $table->timestamps();
        });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('showtimes');
    }
};
