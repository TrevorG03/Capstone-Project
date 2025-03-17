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
        Schema::create('attraction_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->integer('attractionID');
            $table->integer('countryID');
            $table->string('text');
            $table->string('title');
            $table->integer('stars');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attraction_review');
    }
};
