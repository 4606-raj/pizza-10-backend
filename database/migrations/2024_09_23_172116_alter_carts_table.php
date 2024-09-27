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
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('menu_item_id');
            $table->dropColumn('base_id');
            $table->renameColumn('quantity', 'total_quantity');
            $table->renameColumn('amount', 'total_amount');
            $table->double('offer_deduction')->default(0);
            $table->double('discounted_amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
