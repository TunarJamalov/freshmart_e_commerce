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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_category_id')->unsigned()->nullable();
            $table->text('photo')->nullable();
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('total_rating_value')->default(0);
            $table->integer('total_rating_count')->default(0);
            $table->decimal('average_rating', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
