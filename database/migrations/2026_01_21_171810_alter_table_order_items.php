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
        //
        Schema::table('order_items', function(Blueprint $table){
            $table->unsignedBigInteger('size_id')->after('id');
            $table->foreign('size_id')->references('id')->on('product_variants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('order_items', function(Blueprint $table){
            $table->dropForeign('order_items_size_id_foreign');
            $table->dropColumn('size_id');
        });
    }
};
