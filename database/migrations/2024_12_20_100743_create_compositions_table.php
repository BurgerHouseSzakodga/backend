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

        // Győződjünk meg arról, hogy a menu_items és ingredients táblákban léteznek a megfelelő rekordok
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

        // Rétes
        Composition::create(['menu_item_id' => 9, 'ingredient_id' => 1]); // Tészta
        Composition::create(['menu_item_id' => 9, 'ingredient_id' => 2]); // Alma
        Composition::create(['menu_item_id' => 9, 'ingredient_id' => 3]); // Cukor

        // Dobostorta
        Composition::create(['menu_item_id' => 10, 'ingredient_id' => 4]); // Piskóta
        Composition::create(['menu_item_id' => 10, 'ingredient_id' => 5]); // Csokoládékrém
        Composition::create(['menu_item_id' => 10, 'ingredient_id' => 6]); // Karamell

        // Krémes
        Composition::create(['menu_item_id' => 11, 'ingredient_id' => 7]); // Leveles tészta
        Composition::create(['menu_item_id' => 11, 'ingredient_id' => 8]); // Vaníliakrém
        Composition::create(['menu_item_id' => 11, 'ingredient_id' => 9]); // Porcukor

        // Gesztenyepüré
        Composition::create(['menu_item_id' => 12, 'ingredient_id' => 10]); // Gesztenye
        Composition::create(['menu_item_id' => 12, 'ingredient_id' => 11]); // Tejszín
        Composition::create(['menu_item_id' => 12, 'ingredient_id' => 12]); // Rum

        // Tiramisu
        Composition::create(['menu_item_id' => 13, 'ingredient_id' => 13]); // Babapiskóta
        Composition::create(['menu_item_id' => 13, 'ingredient_id' => 14]); // Mascarpone
        Composition::create(['menu_item_id' => 13, 'ingredient_id' => 15]); // Kávé

        // Hasábburgonya
        Composition::create(['menu_item_id' => 14, 'ingredient_id' => 16]); // Burgonya
        Composition::create(['menu_item_id' => 14, 'ingredient_id' => 17]); // Só

        // Sült édesburgonya
        Composition::create(['menu_item_id' => 15, 'ingredient_id' => 18]); // Édesburgonya
        Composition::create(['menu_item_id' => 15, 'ingredient_id' => 19]); // Fűszerkeverék

        // Onion Rings
        Composition::create(['menu_item_id' => 16, 'ingredient_id' => 5]); // Hagyma
        Composition::create(['menu_item_id' => 16, 'ingredient_id' => 21]); // Panír

        // Coleslaw saláta
        Composition::create(['menu_item_id' => 17, 'ingredient_id' => 22]); // Káposzta
        Composition::create(['menu_item_id' => 17, 'ingredient_id' => 4]); // Majonéz

        // Mozzarella sticks
        Composition::create(['menu_item_id' => 18, 'ingredient_id' => 24]); // Mozzarella
        Composition::create(['menu_item_id' => 18, 'ingredient_id' => 25]); // Panír
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compositions');
    }
};