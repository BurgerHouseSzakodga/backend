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

        MenuItem::create(['name' => 'sajtburger', 'description' => 'Marhahúspogácsa zsemlében, ömlesztett cheddar sajtszelettel, savanyú uborkával, hagymával, ketchuppal és mustárral.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/cheeseburger.jpg', 'price' => 1490]);
        MenuItem::create(['name' => 'baconsajtburger', 'description' => 'Marhahúspogácsa zsemlében, bacon szeletekkel, cheddar sajttal, salátával és BBQ szósszal.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/baconburger.jpg', 'price' => 1690]);
        MenuItem::create(['name' => 'csirkeburger', 'description' => 'Ropogós csirkemell zsemlében, salátával, paradicsommal és majonézzel.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/chickenburger.jpg', 'price' => 1390]);
        MenuItem::create(['name' => 'vega burger', 'description' => 'Zöldségpogácsa zsemlében, salátával, paradicsommal, uborkával és vegán majonézzel.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/vegan-burger.jpg', 'price' => 1290]);
        MenuItem::create(['name' => 'dupla sajtburger', 'description' => 'Két marhahúspogácsa, dupla cheddar sajttal, savanyú uborkával és hagymával.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/double-cheeseburger.jpg', 'price' => 1990]);
        MenuItem::create(['name' => 'chilis burger', 'description' => 'Marhahúspogácsa, jalapeno paprikával, cheddar sajttal, salátával és csípős szósszal.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/chiliburger.jpg', 'price' => 1590]);
        MenuItem::create(['name' => 'halas burger', 'description' => 'Ropogós halfilé zsemlében, salátával, tartármártással és citrommal.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/fishburger.jpg', 'price' => 1490]);
        MenuItem::create(['name' => 'grill szendvics', 'description' => 'Grillezett csirkemell, pirított zsemle, salátával, paradicsommal és majonézzel.', 'category_id' => 1, 'image_path' => 'http://localhost:8000/images/grill-sandwich.jpg', 'price' => 1590]);

        MenuItem::create(['name' => 'coca-cola classic', 'description' => 'Frissítő és ikonikus ízvilágával a Cola tökéletes választás a szomjoltáshoz és a feltöltődéshez.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/colaclassic.png', 'price' => 450]);
        MenuItem::create(['name' => 'sprite', 'description' => 'A Sprite frissítő citrom-lime ízével garantáltan felfrissít minden kortyban.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/sprite.png', 'price' => 450]);
        MenuItem::create(['name' => 'coca-cola zero', 'description' => 'Kalóriamentes élvezet a klasszikus Cola ízével.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/colazero.png', 'price' => 450]);
        MenuItem::create(['name' => 'fanta narancs', 'description' => 'Intenzív narancs ízű szénsavas üdítő, ami garantáltan feldobja a hangulatot.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/fanta.png', 'price' => 450]);
        MenuItem::create(['name' => 'pepsi', 'description' => 'Klasszikus kóla íz, ami sosem megy ki a divatból.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/pepsi.png', 'price' => 450]);
        MenuItem::create(['name' => 'schweppes tonic', 'description' => 'Frissítő tonik, amely tökéletes kísérője a koktéloknak is.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/schweppes.png', 'price' => 450]);
        MenuItem::create(['name' => 'bambi', 'description' => 'Retro üdítőital nosztalgikus ízvilággal, ami visszarepít a gyerekkorba.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/bambi.jpg', 'price' => 550]);
        MenuItem::create(['name' => 'ásványvíz szénsavas', 'description' => 'Frissítő szénsavas ásványvíz, amely tökéletes választás a szomjoltáshoz.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/emese_szensavas.png', 'price' => 350]);
        MenuItem::create(['name' => 'ásványvíz mentes', 'description' => 'Tiszta és természetes ásványvíz, szénsav nélkül, a könnyed felfrissülésért.', 'category_id' => 3, 'image_path' => 'http://localhost:8000/images/emese_mentes.jpg', 'price' => 350]);

        MenuItem::create(['name' => 'rétes', 'description' => 'Tradicionális magyar rétes, ropogós tésztával és gazdag töltelékkel. (almás/túrós/mákos)', 'category_id' => 2, 'image_path' => 'http://localhost:8000/images/retes.png', 'price' => 850]);
        MenuItem::create(['name' => 'dobostorta', 'description' => 'Klasszikus magyar torta karamellás tetővel és csokoládékrémmel töltött rétegekkel.', 'category_id' => 2, 'image_path' => 'http://localhost:8000/images/dobostorta.png', 'price' => 1500]);
        MenuItem::create(['name' => 'krémes', 'description' => 'Légies vaníliás krém réteg ropogós leveles tészta között, porcukorral hintve.', 'category_id' => 2, 'image_path' => 'http://localhost:8000/images/kremes.png', 'price' => 750]);
        MenuItem::create(['name' => 'gesztenyepüré', 'description' => 'Tejszínhabbal tálalt gesztenyepüré rumos ízesítéssel.', 'category_id' => 2, 'image_path' => 'http://localhost:8000/images/gesztenyepure.png', 'price' => 900]);
        MenuItem::create(['name' => 'tiramisu', 'description' => 'Olasz klasszikus desszert, kávéval átitatott babapiskótával és lágy mascarpone krémmel.', 'category_id' => 2, 'image_path' => 'http://localhost:8000/images/tiramisu.png', 'price' => 1200]);

        MenuItem::create(['name' => 'hasábburgonya', 'description' => 'Ropogós, aranybarnára sütött hasábburgonya.', 'category_id' => 4, 'image_path' => 'http://localhost:8000/images/hasabburgonya.png', 'price' => 650]);
        MenuItem::create(['name' => 'sült édesburgonya', 'description' => 'Ropogós, fűszeres sült édesburgonya szeletek, a gyorséttermek kedvenc körete.', 'category_id' => 4, 'image_path' => 'http://localhost:8000/images/sult_edesburgonya.png', 'price' => 800]);
        MenuItem::create(['name' => 'onion rings', 'description' => 'Különleges fűszerezésű, ropogós hagymakarikák, tökéletes kiegészítő a főételekhez.', 'category_id' => 4, 'image_path' => 'http://localhost:8000/images/onion_rings.png', 'price' => 850]);
        MenuItem::create(['name' => 'coleslaw saláta', 'description' => 'Friss káposztasaláta majonézes öntettel, klasszikus gyorséttermi köret.', 'category_id' => 4, 'image_path' => 'http://localhost:8000/images/coleslaw.png', 'price' => 600]);
        MenuItem::create(['name' => 'mozzarella sticks', 'description' => 'Ropogós panírozott mozzarella rudak, amelyek belsejében lágy sajt található.', 'category_id' => 4, 'image_path' => 'http://localhost:8000/images/mozzarella_sticks.png', 'price' => 950]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
