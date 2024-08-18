<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model {
  use HasFactory;

  protected $guarded = ['id', 'created_at', 'updated_at'];

  public function getImage() {
    if ($this->image) {
      return url('song/' . $this->image);
    }
    return url('song/default.jpg');
  }

  public function carts() {
    return $this->hasMany(Cart::class);
  }

  public function transactionDetails() {
    return $this->hasMany(TransactionDetail::class);
  }
}
