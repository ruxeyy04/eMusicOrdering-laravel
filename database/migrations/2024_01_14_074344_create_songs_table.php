<?php

use App\Models\Song;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('songs', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('artist');
      $table->string('duration');
      $table->unsignedDouble('price');
      $table->string('image')->nullable();
      $table->timestamps();
    });

    Song::insert([
      [
        'title' => 'Joji - Die For You',
        'artist' => 'Joji',
        'duration' => '3:30',
        'price' => 5.1,
        'image' => null,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'title' => 'Powfu - death bed (coffee for your head)',
        'artist' => 'Powfu',
        'duration' => '2:53',
        'price' => 3.4,
        'image' => null,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'title' => 'Olivia Rodrigo - traitor',
        'artist' => 'Olivia Rodrigo',
        'duration' => '3:49',
        'price' => 4.5,
        'image' => null,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'title' => 'vampire',
        'artist' => 'Olivia Rodrigo',
        'duration' => '3:20',
        'price' => 5.9,
        'image' => null,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'title' => 'Ikaw Lang',
        'artist' => 'NOBITA',
        'duration' => '4:12',
        'price' => 5.3,
        'image' => null,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'title' => 'Come what may',
        'artist' => 'Air Supply',
        'duration' => '5:54',
        'price' => 4.8,
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
    Schema::dropIfExists('songs');
  }
};
