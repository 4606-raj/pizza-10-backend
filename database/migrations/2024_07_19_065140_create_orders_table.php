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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('address_id')->nullable();
            $table->double('total_amount');
            $table->string('payment_mode');
            $table->json('payment_response')->nullable();
            $table->enum('order_type', ['delivery', 'pickup', 'dine-in', 'in-car'])->default('delivery');
            $table->integer('status')->default(1)->comment('1: pending, 2: confirmed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
