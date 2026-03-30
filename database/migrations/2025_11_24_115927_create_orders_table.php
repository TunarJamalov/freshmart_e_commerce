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
            $table->bigInteger('user_id')->nullable();
            $table->text('order_no')->nullable();
            $table->text('payment_method')->nullable();
            $table->text('currency')->nullable();
            $table->decimal('subtotal_price', 10, 2)->nullable();
            $table->decimal('delivery_option_cost', 10, 2)->nullable();
            $table->text('coupon_code')->nullable();
            $table->integer('coupon_discount_percentage')->nullable();
            $table->decimal('coupon_discount_value', 10, 2)->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->text('billing_name')->nullable();
            $table->text('billing_email')->nullable();
            $table->text('billing_phone')->nullable();
            $table->text('billing_address')->nullable();
            $table->text('billing_country')->nullable();
            $table->text('billing_state')->nullable();
            $table->text('billing_city')->nullable();
            $table->text('billing_zip')->nullable();
            $table->text('note')->nullable();
            $table->text('payment_status')->nullable();
            $table->text('delivery_status')->nullable();
            $table->timestamps();
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
