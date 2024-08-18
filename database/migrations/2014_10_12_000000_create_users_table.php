<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('first_name');
      $table->string('last_name');
      $table->string('email')->unique();
      $table->string('contact_number');
      $table->string('gender');
      $table->string('password');
      $table->string('user_type');
      $table->string('image')->nullable();
      $table->timestamps();
    });

    User::insert([
      [
        'first_name' => 'Rodery', 
        'last_name' => 'Villarez',
        'email' => 'admin@gmail.com',
        'contact_number' => '09123456789',
        'gender' => 'female',
        'password' => Hash::make('asd'),
        'user_type' => 'admin',
        'image' => null,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'first_name' => 'Pedro',
        'last_name' => 'Pendoko',
        'email' => 'incharge@gmail.com',
        'contact_number' => '09123456789',
        'gender' => 'female',
        'password' => Hash::make('asd'),
        'user_type' => 'incharge',
        'image' => null,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'first_name' => 'John',
        'last_name' => 'Cenas',
        'email' => 'user@gmail.com',
        'contact_number' => '09123456789',
        'gender' => 'female',
        'password' => Hash::make('asd'),
        'user_type' => 'client',
        'image' => null,
        'created_at' => now(),
        'updated_at' => now()
      ],
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('users');
  }
};
