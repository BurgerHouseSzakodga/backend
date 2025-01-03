<?php

use App\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('készül');
            $table->integer('total');
            $table->timestamps();
        });

        Order::create([
            'user' => 1,
            'status' => 'készül',
            'total' => 3750
        ]);

        Order::create([
            'user' => 2,
            'status' => 'készül',
            'total' => 4660
        ]);

        Order::create([
            'user' => 3,
            'status' => 'készül',
            'total' => 8950
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);


        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);

        Order::create([
            'user' => rand(1, 3),
            'status' => 'átvéve',
            'total' => rand(2000, 15000),
            'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30))
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
