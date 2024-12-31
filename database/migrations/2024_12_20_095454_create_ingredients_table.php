<?php

use App\Models\Ingredient;
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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('extra_price');
            $table->timestamps();
        });

        Ingredient::create(['name' => 'sajt', 'extra_price' => 300]);

        Ingredient::create(['name' => 'ketchup', 'extra_price' => 200]);
        Ingredient::create(['name' => 'mustár', 'extra_price' => 100]);
        Ingredient::create(['name' => 'majonéz', 'extra_price' => 300]);

        Ingredient::create(['name' => 'hagyma', 'extra_price' => 100]);
        Ingredient::create(['name' => 'uborka', 'extra_price' => 300]);
        Ingredient::create(['name' => 'paradicsom', 'extra_price' => 300]);
        Ingredient::create(['name' => 'jégsaláta', 'extra_price' => 150]);
        Ingredient::create(['name' => 'jalapeno', 'extra_price' => 200]);

        Ingredient::create(['name' => 'húspogácsa', 'extra_price' => 500]);
        Ingredient::create(['name' => 'bacon', 'extra_price' => 300]);
        Ingredient::create(['name' => 'halpogácsa', 'extra_price' => 300]);
        Ingredient::create(['name' => 'csirkemell', 'extra_price' => 300]);
        Ingredient::create(['name' => 'vega hús', 'extra_price' => 300]);

        Ingredient::create(['name' => 'buci', 'extra_price' => 300]);
        Ingredient::create(['name' => 'toast kenyér', 'extra_price' => 300]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
