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
        Schema::table('orders', function(Blueprint $table){
            $table->dropColumn('notes');
            $table->dropColumn('shipping_address');
            $table->dropColumn('shipping_status');
            $table->dropColumn('payment_status');
            $table->unsignedBigInteger('size_id')->after('id');
            $table->unsignedBigInteger('product_id')->after('size_id');

            //foreign
            $table->foreign('size_id')->references('id')->on('product_variants')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('orders', function(Blueprint $table){
            $table->string('notes');
            $table->string('shipping_address');
            $table->string('shipping_status');
            $table->string('payment_status');
            $table->dropForeign('orders_size_id_foreign');
            $table->dropForeign('orders_product_id_foreign');
            $table->dropColumn('size_id');
            $table->dropColumn('product_id');
        });
    }
};
