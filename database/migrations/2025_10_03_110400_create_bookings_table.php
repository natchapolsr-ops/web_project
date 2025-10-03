<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('bookings')) {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('showtime_id')->constrained('showtimes')->cascadeOnDelete();
            $table->enum('status', ['pending','paid','cancelled'])->default('pending');
            $table->unsignedInteger('total_amount')->default(0);
            $table->timestamps();
        });
        }
        if (!Schema::hasTable('booking_seat')) {
        Schema::create('booking_seat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->foreignId('seat_id')->constrained('seats')->cascadeOnDelete();
            $table->unsignedInteger('price');
            $table->timestamps();
            $table->unique(['booking_id','seat_id']);
        });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_seat');
        Schema::dropIfExists('bookings');
    }
};
