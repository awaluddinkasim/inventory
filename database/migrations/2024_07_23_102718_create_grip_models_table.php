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
        Schema::create('grip_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id');
            $table->string('name');
            $table->string('url');
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('grip_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grip_models');
    }
};
