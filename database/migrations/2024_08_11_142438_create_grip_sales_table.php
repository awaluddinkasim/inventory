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
        Schema::create('grip_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grip_id');
            $table->double('retail');
            $table->integer('quantity');
            $table->date('date');
            $table->timestamps();

            $table->foreign('grip_id')->references('id')->on('grips')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grip_sales');
    }
};
