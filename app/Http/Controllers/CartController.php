<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller {
  public function store() {
    // dd(request()->all());
    $user_id = auth()->id();
    $song_id = request()->get('song_id');

    Cart::create(
      [
        'user_id' => $user_id,
        'song_id' => $song_id,
      ]
    );

    return redirect()->route('songs.index')->with('success', 'Song added to cart');
  }

  public function index() {
    $user_id = auth()->id();
    $carts = Cart::where('user_id', $user_id)
      ->orderBy('created_at', 'DESC')
      ->paginate(10);

    return view('client.cart', compact('carts'));
  }

  public function destroy(Cart $cart) {
    $cart->delete();

    return redirect()->route('carts.index')->with('success', 'Song removed from cart');
  }
}
