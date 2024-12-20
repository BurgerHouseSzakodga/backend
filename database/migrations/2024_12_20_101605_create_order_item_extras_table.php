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
        Schema::create('order_item_extras', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('menu_item_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->boolean('modification_type')->default(false);
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->primary(['order_id', 'menu_item_id', 'ingredient_id']);

            $table->foreign('order_id')->references('order_id')->on('order_items');
            $table->foreign('menu_item_id')->references('menu_item_id')->on('order_items');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_extras');
    }
};
