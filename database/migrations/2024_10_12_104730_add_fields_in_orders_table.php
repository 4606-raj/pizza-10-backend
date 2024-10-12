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
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('total_quantity')->nullable()->after('total_amount');
            $table->double('offer_deduction')->nullable()->after('total_amount');
            $table->double('discounted_amount')->nullable()->after('total_amount');
            $table->integer('offer_id')->nullable()->after('total_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('total_quantity');
            $table->dropColumn('offer_deduction');
            $table->dropColumn('discounted_amount');
            $table->dropColumn('offer_id');
        });
    }
};
