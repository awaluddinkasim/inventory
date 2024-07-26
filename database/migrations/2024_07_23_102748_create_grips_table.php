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
        Schema::create('grips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id');
            $table->foreignId('size_id');
            $table->string('color');
            $table->string('weight');
            $table->string('core_size');
            $table->double('wholesale');
            $table->integer('percent');
            $table->timestamps();

            $table->foreign('model_id')->references('id')->on('grip_models')->cascadeOnDelete();
            $table->foreign('size_id')->references('id')->on('grip_sizes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grips');
    }
};
