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
        Schema::create('shafts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('type_id');
            $table->string('shaft');
            $table->string('flex');
            $table->float('length');
            $table->string('weight');
            $table->double('wholesale');
            $table->integer('percent');
            $table->double('retail');
            $table->string('img');
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('shaft_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shafts');
    }
};
