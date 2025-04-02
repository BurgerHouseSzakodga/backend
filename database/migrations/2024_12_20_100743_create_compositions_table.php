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

            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
            $table->foreign('menu_item_id')->references('id')->on('menu_items')->onDelete('cascade');
        });

        // Sajtburger
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 1]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 2]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 3]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 5]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 6]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 7]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 8]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 10]);
        Composition::create(['menu_item_id' => 1, 'ingredient_id' => 15]);

        // Baconsajtburger
        Composition::create(['menu_item_id' => 2, 'ingredient_id' => 1]);
        Composition::create(['menu_item_id' => 2, 'ingredient_id' => 2]);
        Composition::create(['menu_item_id' => 2, 'ingredient_id' => 3]);
        Composition::create(['menu_item_id' => 2, 'ingredient_id' => 5]);
        Composition::create(['menu_item_id' => 2, 'ingredient_id' => 6]);
        Composition::create(['menu_item_id' => 2, 'ingredient_id' => 7]);
        Composition::create(['menu_item_id' => 2, 'ingredient_id' => 8]);
        Composition::create(['menu_item_id' => 2, 'ingredient_id' => 10]);
        Composition::create(['menu_item_id' => 2, 'ingredient_id' => 11]);
        Composition::create(['menu_item_id' => 2, 'ingredient_id' => 15]);

        // Csirkeburger
        Composition::create(['menu_item_id' => 3, 'ingredient_id' => 1]);
        Composition::create(['menu_item_id' => 3, 'ingredient_id' => 4]);
        Composition::create(['menu_item_id' => 3, 'ingredient_id' => 7]);
        Composition::create(['menu_item_id' => 3, 'ingredient_id' => 8]);
        Composition::create(['menu_item_id' => 3, 'ingredient_id' => 13]);
        Composition::create(['menu_item_id' => 3, 'ingredient_id' => 15]);

        // Vega burger
        Composition::create(['menu_item_id' => 4, 'ingredient_id' => 1]);
        Composition::create(['menu_item_id' => 4, 'ingredient_id' => 4]);
        Composition::create(['menu_item_id' => 4, 'ingredient_id' => 7]);
        Composition::create(['menu_item_id' => 4, 'ingredient_id' => 8]);
        Composition::create(['menu_item_id' => 4, 'ingredient_id' => 14]);
        Composition::create(['menu_item_id' => 4, 'ingredient_id' => 15]);

        // Dupla sajtburger
        Composition::create(['menu_item_id' => 5, 'ingredient_id' => 1]);
        Composition::create(['menu_item_id' => 5, 'ingredient_id' => 2]);
        Composition::create(['menu_item_id' => 5, 'ingredient_id' => 3]);
        Composition::create(['menu_item_id' => 5, 'ingredient_id' => 5]);
        Composition::create(['menu_item_id' => 5, 'ingredient_id' => 6]);
        Composition::create(['menu_item_id' => 5, 'ingredient_id' => 7]);
        Composition::create(['menu_item_id' => 5, 'ingredient_id' => 8]);
        Composition::create(['menu_item_id' => 5, 'ingredient_id' => 10]);
        Composition::create(['menu_item_id' => 5, 'ingredient_id' => 11]);
        Composition::create(['menu_item_id' => 5, 'ingredient_id' => 15]);

        // Chilis burger
        Composition::create(['menu_item_id' => 6, 'ingredient_id' => 1]);
        Composition::create(['menu_item_id' => 6, 'ingredient_id' => 2]);
        Composition::create(['menu_item_id' => 6, 'ingredient_id' => 3]);
        Composition::create(['menu_item_id' => 6, 'ingredient_id' => 5]);
        Composition::create(['menu_item_id' => 6, 'ingredient_id' => 6]);
        Composition::create(['menu_item_id' => 6, 'ingredient_id' => 7]);
        Composition::create(['menu_item_id' => 6, 'ingredient_id' => 8]);
        Composition::create(['menu_item_id' => 6, 'ingredient_id' => 9]);
        Composition::create(['menu_item_id' => 6, 'ingredient_id' => 10]);
        Composition::create(['menu_item_id' => 6, 'ingredient_id' => 15]);

        // Halas burger
        Composition::create(['menu_item_id' => 7, 'ingredient_id' => 1]);
        Composition::create(['menu_item_id' => 7, 'ingredient_id' => 4]);
        Composition::create(['menu_item_id' => 7, 'ingredient_id' => 7]);
        Composition::create(['menu_item_id' => 7, 'ingredient_id' => 8]);
        Composition::create(['menu_item_id' => 7, 'ingredient_id' => 12]);
        Composition::create(['menu_item_id' => 7, 'ingredient_id' => 15]);

        // Grill szendvics
        Composition::create(['menu_item_id' => 8, 'ingredient_id' => 1]);
        Composition::create(['menu_item_id' => 8, 'ingredient_id' => 8]);
        Composition::create(['menu_item_id' => 8, 'ingredient_id' => 11]);
        Composition::create(['menu_item_id' => 8, 'ingredient_id' => 16]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compositions');
    }
};
