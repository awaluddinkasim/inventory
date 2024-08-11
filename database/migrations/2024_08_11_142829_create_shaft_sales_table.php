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
        Schema::create('shaft_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shaft_id');
            $table->double('retail');
            $table->integer('quantity');
            $table->date('date');
            $table->timestamps();

            $table->foreign('shaft_id')->references('id')->on('shafts')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shaft_sales');
    }
};
