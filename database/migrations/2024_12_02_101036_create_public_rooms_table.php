<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('public_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('publicRoom')->unique(); // Adds the 'username' column with a unique constraint
            $table->string('nickname')->nullable(); // Add nickname column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_rooms');
    }
};
