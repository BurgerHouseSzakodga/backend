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
            $table->unsignedBigInteger('basket_id'); 
            $table->unsignedBigInteger('item_id');  
            $table->integer('ingredient');          
            $table->boolean('modification_type')->default(0);
            $table->integer('quantity');
        
            // Összetett kulcs
            $table->primary(['basket_id', 'item_id', 'ingredient']);

            $table->timestamps();
        
            // Idegen kulcsok beállítása
            $table->foreign(['basket_id', 'item_id'])
                  ->references(['basket_id', 'item_id']) // Pontos mezőnevek
                  ->on('basket_items');
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
