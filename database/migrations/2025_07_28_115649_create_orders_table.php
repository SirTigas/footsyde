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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            //order info
            $table->decimal('total_price', 8, 2);
            $table->string('status', 30);
            $table->string('payment_method', 30);
            $table->string('payment_status', 30);

            //shipping
            $table->string('shipping_address');
            $table->string('shipping_status');
            $table->string('notes', 100);

            $table->timestamps();

            //defining foreign key
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
