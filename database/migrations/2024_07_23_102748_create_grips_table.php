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
            $table->string('code')->unique();
            $table->foreignId('model_id');
            $table->string('size');
            $table->string('color');
            $table->float('weight');
            $table->string('core_size');
            $table->double('wholesale');
            $table->integer('percent');
            $table->double('retail');
            $table->timestamps();

            $table->foreign('model_id')->references('id')->on('grip_models')->cascadeOnDelete();
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
