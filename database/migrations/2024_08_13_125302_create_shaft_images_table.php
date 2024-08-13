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
        Schema::create('shaft_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shaft_id');
            $table->string('filename');
            $table->timestamps();

            $table->foreign('shaft_id')->references('id')->on('shafts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shaft_images');
    }
};
