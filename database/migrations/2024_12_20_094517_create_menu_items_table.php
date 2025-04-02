<?php

use App\Http\Controllers\MenuItemController;
use App\Models\MenuItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('image_path')->unique();
            $table->integer('price');
            $table->integer('discount_amount')->default(0);
            $table->timestamps();
        });

        // Burgerek
        MenuItem::create(['name' => 'sajtburger', 'description' => 'Marhahúspogácsa zsemlében, ömlesztett cheddar sajtszelettel, savanyú uborkával, hagymával, ketchuppal és mustárral.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/cheeseburger.jpg', 'price' => 1490]);
        MenuItem::create(['name' => 'baconsajtburger', 'description' => 'Marhahúspogácsa zsemlében, bacon szeletekkel, cheddar sajttal, salátával és BBQ szósszal.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/baconburger.jpg', 'price' => 1690]);
        MenuItem::create(['name' => 'csirkeburger', 'description' => 'Ropogós csirkemell zsemlében, salátával, paradicsommal és majonézzel.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/chickenburger.jpg', 'price' => 1390]);
        MenuItem::create(['name' => 'vega burger', 'description' => 'Zöldségpogácsa zsemlében, salátával, paradicsommal, uborkával és vegán majonézzel.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/vegan-burger.jpg', 'price' => 1290]);
        MenuItem::create(['name' => 'dupla sajtburger', 'description' => 'Két marhahúspogácsa, dupla cheddar sajttal, savanyú uborkával és hagymával.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/double-cheeseburger.jpg', 'price' => 1990]);
        MenuItem::create(['name' => 'chilis burger', 'description' => 'Marhahúspogácsa, jalapeno paprikával, cheddar sajttal, salátával és csípős szósszal.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/chiliburger.jpg', 'price' => 1590]);
        MenuItem::create(['name' => 'halas burger', 'description' => 'Ropogós halfilé zsemlében, salátával, tartármártással és citrommal.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/fishburger.jpg', 'price' => 1490]);
        MenuItem::create(['name' => 'grill szendvics', 'description' => 'Grillezett csirkemell, pirított zsemle, salátával, paradicsommal és majonézzel.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/grill-sandwich.jpg', 'price' => 1590]);

        // Italok
        MenuItem::create(['name' => 'Coca-Cola', 'description' => 'Frissítő szénsavas üdítőital.', 'category_id' => 2, 'image_path' => 'http://localhost:8000/images/coca-cola.jpg', 'price' => 490]);
        MenuItem::create(['name' => 'Narancslé', 'description' => '100%-os frissen facsart narancslé.', 'category_id' => 2, 'image_path' => 'http://localhost:8000/images/orange-juice.jpg', 'price' => 590]);
        MenuItem::create(['name' => 'Ásványvíz', 'description' => 'Szénsavmentes ásványvíz.', 'category_id' => 2, 'image_path' => 'http://localhost:8000/images/mineral-water.jpg', 'price' => 390]);

        // Köretek
        MenuItem::create(['name' => 'Hasábburgonya', 'description' => 'Ropogósra sült hasábburgonya.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/french-fries.jpg', 'price' => 690]);
        MenuItem::create(['name' => 'Rizs', 'description' => 'Párolt fehér rizs.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/rice.jpg', 'price' => 590]);
        MenuItem::create(['name' => 'Saláta', 'description' => 'Friss zöldségekből készült saláta.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/salad.jpg', 'price' => 790]);

        // Desszertek
        MenuItem::create(['name' => 'Csokoládétorta', 'description' => 'Gazdag csokoládés sütemény.', 'category_id' => 4, 'image_path' => 'http://localhost:8000/images/chocolate-cake.jpg', 'price' => 990]);
        MenuItem::create(['name' => 'Fagylaltkehely', 'description' => 'Három gombóc fagylalt tejszínhabbal.', 'category_id' => 4, 'image_path' => 'http://localhost:8000/images/ice-cream.jpg', 'price' => 890]);
        MenuItem::create(['name' => 'Gyümölcssaláta', 'description' => 'Friss gyümölcsökből készült saláta.', 'category_id' => 4, 'image_path' => 'http://localhost:8000/images/fruit-salad.jpg', 'price' => 790]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
