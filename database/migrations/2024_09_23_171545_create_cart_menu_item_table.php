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
        Schema::create('cart_menu_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id');
            $table->foreignId('menu_item_id');
            $table->foreignId('base_id');
            $table->integer('quantity')->default(1);
            $table->double('amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_menu_item');
    }
};
