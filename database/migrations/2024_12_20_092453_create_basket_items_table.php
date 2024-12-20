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
        Schema::create('basket_items', function (Blueprint $table) {
            $table->unsignedBigInteger('basket_id');
            $table->unsignedBigInteger('item_id'); 
            $table->integer('quantity');           
            $table->timestamps();
        
            // Összetett kulcs
            $table->primary(['basket_id', 'item_id']);
        
            // Idegen kulcsok
            $table->foreign('basket_id')
                  ->references('basket_id')
                  ->on('baskets');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket_items');
    }
};
