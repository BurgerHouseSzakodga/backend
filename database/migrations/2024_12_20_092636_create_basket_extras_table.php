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
        Schema::create('basket_extras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('basket_item_id');
            $table->integer('ingredient');
            $table->integer('quantity');

            $table->timestamps();

            $table->foreign('basket_item_id')
                ->references('id')
                ->on('basket_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket_extras');
    }
};
