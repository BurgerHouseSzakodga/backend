<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->string('email',50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->string('address',100)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.hu',
            'password' => 'admin123',
            'is_admin' => true,
            'address' => '2040, Budaörs, Lévai utca, 29'
        ]);

        User::create([
            'name' => 'Gergő',
            'email' => 'gergolajko@gmail.com',
            'password' => 'gergo123',
            'is_admin' => false,
            'address' => '2040, Budaörs, Lévai utca, 29'
        ]);

        User::create([
            'name' => 'Ákos',
            'email' => 'akoskosztolanyi@gmail.com',
            'password' => 'akos123',
            'is_admin' => false,
            'address' => '2040, Budaörs, Lévai utca, 29'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
