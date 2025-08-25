<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
          Schema::create('seos', function (Blueprint $table) {
            $table->id();
            
            $table->string('model_type')->nullable(); 
            $table->unsignedBigInteger('model_id')->nullable();
            $table->json('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('meta_robots')->default('index, follow');
            $table->string('og_image')->nullable();
            $table->unique(['model_type', 'model_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
