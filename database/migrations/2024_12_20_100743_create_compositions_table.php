<?php

use App\Models\Composition;
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
        Schema::create('compositions', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_item_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->timestamps();

            $table->primary(['ingredient_id', 'menu_item_id']);

            $table->foreign('ingredient_id')->references('id')->on('ingredients');
            $table->foreign('menu_item_id')->references('id')->on('menu_items');
        });

        //Sajtburger
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 1]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 2]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 3]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 4]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 5]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 6]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 7]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compositions');
    }
};
