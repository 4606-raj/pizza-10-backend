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
        Schema::dropIfExists('cart_order');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('cart_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained();
            $table->foreignId('order_id')->constrained();
            $table->timestamps();
        });
    }
};
