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
        Schema::create('grip_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grip_id');
            $table->string('filename');
            $table->timestamps();

            $table->foreign('grip_id')->references('id')->on('grips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grip_images');
    }
};
