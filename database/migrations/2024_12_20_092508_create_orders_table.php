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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('delivery_address')->nullable();
            $table->string('status')->default('készül');
            $table->integer('total');
            $table->timestamps();
        });

        $addresses = [
            'Budapest, Kossuth Lajos utca 2.',
            'Budapest, Petőfi Sándor utca 5.',
            'Érd, Nagyerdei körút 12.',
            'Diósd, Tisza Lajos körút 8.',
            'Budaörs, Baross Gábor utca 3.',
        ];

        for ($i = 0; $i < 40; $i++) {
            Order::create([
                'user_id' => rand(1, 3),
                'status' => 'kiszállítva',
                'total' => 0,
                'delivery_address' => rand(0, 1) ? $addresses[array_rand($addresses)] : null,
                'created_at' => Carbon\Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
