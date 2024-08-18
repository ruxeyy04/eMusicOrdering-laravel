<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $guarded = ['id', 'created_at', 'updated_at'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'password' => 'hashed',
  ];

  public function getImage() {
    if ($this->image) {
      return url('profile/'. $this->image);
    }
    return url('profile/default.jpg');
  }

  public function carts() {
    return $this->hasMany(Cart::class)->latest();
  }
  
  public function transactions() {
    return $this->hasMany(Transaction::class)->latest();
  }
}
