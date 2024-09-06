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
        \DB::table('offers')->truncate();
        
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('offer_type_id')->after('offer_category_id')->constrained();
            $table->double('offer_value')->after('code')->nullable();
            $table->string('condition')->after('code')->nullable();
            $table->double('condition_value')->after('code')->nullable();
            $table->string('condition_type')->after('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign('offers_offer_type_id_foreign');
            $table->dropColumn('offer_type_id');
            $table->dropColumn('offer_value');
            $table->dropColumn('condition');
            $table->dropColumn('condition_value');
            $table->dropColumn('condition_type');
        });
    }
};
