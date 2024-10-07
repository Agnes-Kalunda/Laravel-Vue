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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('content', 1000);
            $table->string('image', 255)->nullable();
            $table->timestamps(0); // Adjust if you want default timestamp precision
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};