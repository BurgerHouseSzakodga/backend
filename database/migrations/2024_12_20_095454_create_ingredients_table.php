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
            $table->string('name');
            $table->integer('extra_price');
            $table->timestamps();
        });

        Ingredient::create(['name'=>'sajt','extra_price'=>300]);
        Ingredient::create(['name'=>'ketchup','extra_price'=>200]);
        Ingredient::create(['name'=>'mustár','extra_price'=>300]);
        Ingredient::create(['name'=>'hagyma','extra_price'=>300]);
        Ingredient::create(['name'=>'uborka','extra_price'=>300]);
        Ingredient::create(['name'=>'buci','extra_price'=>300]);
        Ingredient::create(['name'=>'húspogácsa','extra_price'=>500]);
        Ingredient::create(['name'=>'bacon','extra_price'=>300]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
