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
        Schema::create('coffee_impressions', function (Blueprint $table) {
            $table->id();
            $table->string('coffeeName');
            $table->date('purchaseDate');
            $table->integer('price');
            $table->string('place');
            $table->integer('rate');
            $table->integer('scent');
            $table->integer('acidity');
            $table->integer('bitter');
            $table->integer('rich');
            $table->integer('taste');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coffee_impressions');
    }
};
