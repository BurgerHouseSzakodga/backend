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
            $table->string('name');
            $table->text('description');
            $table->foreignId('category')->constrained('categories');
            $table->string('image_path');
            $table->integer('price');
            $table->timestamps();
        });
        MenuItem::create(['name' => 'sajtburger', 'description' => 'Marhahúspogácsa zsemlében, ömlesztett cheddar sajtszelettel, savanyú uborkával, hagymával, ketchuppal és mustárral.', 'category' => 1, 'image_path' => 'aa', 'price' => 1490]);
        MenuItem::create(['name' => 'baconsajtburger', 'description' => 'Marhahúspogácsa zsemlében, bacon szeletekkel, cheddar sajttal, salátával és BBQ szósszal.', 'category' => 1, 'image_path' => 'bb', 'price' => 1690]);
        MenuItem::create(['name' => 'csirkeburger', 'description' => 'Ropogós csirkemell zsemlében, salátával, paradicsommal és majonézzel.', 'category' => 1, 'image_path' => 'cc', 'price' => 1390]);
        MenuItem::create(['name' => 'vega burger', 'description' => 'Zöldségpogácsa zsemlében, salátával, paradicsommal, uborkával és vegán majonézzel.', 'category' => 1, 'image_path' => 'dd', 'price' => 1290]);
        MenuItem::create(['name' => 'dupla sajtburger', 'description' => 'Két marhahúspogácsa, dupla cheddar sajttal, savanyú uborkával és hagymával.', 'category' => 1, 'image_path' => 'ee', 'price' => 1990]);
        MenuItem::create(['name' => 'chilis burger', 'description' => 'Marhahúspogácsa, jalapeno paprikával, cheddar sajttal, salátával és csípős szósszal.', 'category' => 1, 'image_path' => 'ff', 'price' => 1590]);
        MenuItem::create(['name' => 'halas burger', 'description' => 'Ropogós halfilé zsemlében, salátával, tartármártással és citrommal.', 'category' => 1, 'image_path' => 'gg', 'price' => 1490]);
        MenuItem::create(['name' => 'grill szendvics', 'description' => 'Grillezett csirkemell, pirított zsemle, salátával, paradicsommal és majonézzel.', 'category' => 1, 'image_path' => 'hh', 'price' => 1590]);
        MenuItem::create(['name' => 'gyerek menü', 'description' => 'Mini sajtburger, sült krumpli és gyümölcslé.', 'category' => 1, 'image_path' => 'jj', 'price' => 1190]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
