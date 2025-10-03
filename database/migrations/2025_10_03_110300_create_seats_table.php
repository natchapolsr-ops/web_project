<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('seats')) {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('theater_id')->constrained('theaters')->cascadeOnDelete();
            $table->string('row'); // e.g., A, B, C
            $table->unsignedInteger('number');
            $table->enum('type', ['normal','honeymoon','opera','vip','disabled'])->default('normal');
            $table->unsignedInteger('price_delta')->default(0); // additional price on top of base
            $table->timestamps();
            $table->unique(['theater_id','row','number']);
        });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
