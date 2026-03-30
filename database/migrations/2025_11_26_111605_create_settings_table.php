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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('logo')->nullable();
            $table->text('favicon')->nullable();
            $table->text('top_bar_phone')->nullable();
            $table->text('top_bar_email')->nullable();
            $table->text('footer_facebook')->nullable();
            $table->text('footer_twitter')->nullable();
            $table->text('footer_linkedin')->nullable();
            $table->text('footer_instagram')->nullable();
            $table->text('footer_address')->nullable();
            $table->text('footer_phone')->nullable();
            $table->text('footer_email')->nullable();
            $table->text('footer_working_hours')->nullable();
            $table->text('footer_copyright')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
