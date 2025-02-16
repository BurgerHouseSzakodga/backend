<?php

use App\Models\OrderItem;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('menu_item_id');
            $table->integer('menu_item_quantity')->default(1);
            $table->integer('buying_price')->default(0);
            $table->timestamps();

            $table->primary(['order_id', 'menu_item_id']);

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('menu_item_id')->references('id')->on('menu_items')->onDelete('cascade');
        });

        OrderItem::create([
            'order_id' => 1,
            'menu_item_id' => 1,
            'menu_item_quantity' => 2,
        ]);

        OrderItem::create([
            'order_id' => 1,
            'menu_item_id' => 2,
            'menu_item_quantity' => 1,
        ]);

        OrderItem::create([
            'order_id' => 2,
            'menu_item_id' => 1,
            'menu_item_quantity' => 3,
        ]);

        OrderItem::create([
            'order_id' => 2,
            'menu_item_id' => 3,
            'menu_item_quantity' => 1,
        ]);

        OrderItem::create([
            'order_id' => 3,
            'menu_item_id' => 2,
            'menu_item_quantity' => 2,
        ]);

        OrderItem::create([
            'order_id' => 3,
            'menu_item_id' => 4,
            'menu_item_quantity' => 1,
        ]);

        OrderItem::create([
            'order_id' => 4,
            'menu_item_id' => 3,
            'menu_item_quantity' => 1,
        ]);

        OrderItem::create([
            'order_id' => 4,
            'menu_item_id' => 5,
            'menu_item_quantity' => 2,
        ]);

        OrderItem::create([
            'order_id' => 5,
            'menu_item_id' => 1,
            'menu_item_quantity' => 1,
        ]);

        OrderItem::create([
            'order_id' => 5,
            'menu_item_id' => 4,
            'menu_item_quantity' => 3,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
