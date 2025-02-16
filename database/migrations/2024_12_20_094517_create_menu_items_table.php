<?php

use App\Http\Controllers\MenuItemController;
use App\Models\MenuItem;
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

        MenuItem::create(['name' => 'sajtburger', 'description' => 'Marhahúspogácsa zsemlében, ömlesztett cheddar sajtszelettel, savanyú uborkával, hagymával, ketchuppal és mustárral.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/cheeseburger.jpg', 'price' => 1490]);
        MenuItem::create(['name' => 'baconsajtburger', 'description' => 'Marhahúspogácsa zsemlében, bacon szeletekkel, cheddar sajttal, salátával és BBQ szósszal.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/baconburger.jpg', 'price' => 1690]);
        MenuItem::create(['name' => 'csirkeburger', 'description' => 'Ropogós csirkemell zsemlében, salátával, paradicsommal és majonézzel.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/chickenburger.jpg', 'price' => 1390]);
        MenuItem::create(['name' => 'vega burger', 'description' => 'Zöldségpogácsa zsemlében, salátával, paradicsommal, uborkával és vegán majonézzel.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/vegan-burger.jpg', 'price' => 1290]);
        MenuItem::create(['name' => 'dupla sajtburger', 'description' => 'Két marhahúspogácsa, dupla cheddar sajttal, savanyú uborkával és hagymával.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/double-cheeseburger.jpg', 'price' => 1990]);
        MenuItem::create(['name' => 'chilis burger', 'description' => 'Marhahúspogácsa, jalapeno paprikával, cheddar sajttal, salátával és csípős szósszal.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/chiliburger.jpg', 'price' => 1590]);
        MenuItem::create(['name' => 'halas burger', 'description' => 'Ropogós halfilé zsemlében, salátával, tartármártással és citrommal.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/fishburger.jpg', 'price' => 1490]);
        MenuItem::create(['name' => 'grill szendvics', 'description' => 'Grillezett csirkemell, pirított zsemle, salátával, paradicsommal és majonézzel.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/grill-sandwich.jpg', 'price' => 1590]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
