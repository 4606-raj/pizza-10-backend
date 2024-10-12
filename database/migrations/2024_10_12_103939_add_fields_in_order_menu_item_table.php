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
        Schema::table('order_menu_items', function (Blueprint $table) {
            $table->dropForeign('order_menu_items_menu_item_price_id_foreign');
            $table->dropColumn('menu_item_price_id');
            $table->foreignId('base_id');
            $table->double('amount')->nullable()->after('menu_item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_menu_items', function (Blueprint $table) {
            $table->integer('menu_item_price_id');
            $table->dropColumn('base_id');
            $table->dropColumn('amount');
        });
    }
};
