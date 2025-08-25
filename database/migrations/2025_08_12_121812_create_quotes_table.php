<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_read')->default(false);
            $table->boolean('is_replied')->default(false);
            $table->string('reply')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
