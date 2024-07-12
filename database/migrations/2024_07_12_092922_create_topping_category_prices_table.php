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
        Schema::create('topping_category_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topping_category_id')->constrained();
            $table->foreignId('base_id')->constrained();
            $table->double('price')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topping_category_prices');
    }
};
