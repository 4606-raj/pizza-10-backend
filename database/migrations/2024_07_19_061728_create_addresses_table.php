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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('house_no')->nullable();
            $table->string('street_landmark')->nullable();
            $table->string('sector_village')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('details')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
