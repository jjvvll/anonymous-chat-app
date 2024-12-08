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
        Schema::create('private_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('nickname'); // Nickname for the room
            $table->string('owner')->nullable(); // ID of the room owner
            $table->string('password')->nullable(); // Password for the room (nullable if no password is required)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_rooms');
    }
};
