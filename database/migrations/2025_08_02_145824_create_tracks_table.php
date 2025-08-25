<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('country_sender_id')->nullable();
            $table->foreign('country_sender_id')->references('id')->on('countries')->nullOnDelete();

            $table->unsignedInteger('state_sender_id')->nullable();
            $table->foreign('state_sender_id')->references('id')->on('states')->nullOnDelete();

            $table->unsignedInteger('city_sender_id')->nullable();
            $table->foreign('city_sender_id')->references('id')->on('cities')->nullOnDelete();

            $table->unsignedInteger('country_reseved_id')->nullable();
            $table->foreign('country_reseved_id')->references('id')->on('countries')->nullOnDelete();

            $table->unsignedInteger('state_reseved_id')->nullable();
            $table->foreign('state_reseved_id')->references('id')->on('states')->nullOnDelete();

            $table->unsignedInteger('city_reseved_id')->nullable();
            $table->foreign('city_reseved_id')->references('id')->on('cities')->nullOnDelete();

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
