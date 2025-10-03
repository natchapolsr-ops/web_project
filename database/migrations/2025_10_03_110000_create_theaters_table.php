<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('theaters')) {
        Schema::create('theaters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('screen_number')->nullable();
            $table->unsignedInteger('rows')->default(10);
            $table->unsignedInteger('cols')->default(18);
            $table->timestamps();
        });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('theaters');
    }
};
