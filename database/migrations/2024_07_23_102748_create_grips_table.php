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
            $table->timestamps();
            $table->foreignId('id_model');
            $table->foreignId('id_size');
            $table->string('color');
            $table->string('weight');
            $table->string('core_size');
            $table->integer('wholesale');
            $table->integer('percent');


            $table->foreign('id_model')->references('id')->on('grip_models');
            $table->foreign('id_size')->references('id')->on('sizes');
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
