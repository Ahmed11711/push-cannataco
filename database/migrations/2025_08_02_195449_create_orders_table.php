<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained('merchants')->onDelete('cascade');
            $table->foreignId('track_id')->constrained('tracks')->onDelete('cascade');
            $table->string('serial_number')->unique()->nullable();
            $table->decimal('total_amount')->default(0.00);
            $table->enum('status', [
                'pending',
                'received',
                'confirmed',
                'processing',
                'ready_for_pickup',
                'out_for_delivery',
                'delivered',
                'failed',
                'returned'
            ])->default('pending');

            $table->string('name_sender')->nullable();
            $table->string('phone_sender')->nullable();
            $table->string('address_sender')->nullable();
            $table->string('email_sender')->nullable();

            $table->string('name_received')->nullable();
            $table->string('phone_received')->nullable();
            $table->string('email_received')->nullable();

            $table->dateTime('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
