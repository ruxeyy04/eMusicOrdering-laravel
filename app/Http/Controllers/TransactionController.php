<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Song;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;

class TransactionController extends Controller {
  public function store() {
    $user_id = auth()->id();
    $song_ids = request()->get('song_ids', []);

    Cart::where('user_id', $user_id)->delete();

    $newTransaction = Transaction::create([
      'user_id' => $user_id,
      'status' => 'pending',
    ]);
    $newTransactionId = $newTransaction->id;

    foreach ($song_ids as $song_id) {
      TransactionDetail::create([
        'transaction_id' => $newTransactionId,
        'song_id' => $song_id,
      ]);
    }

    return redirect()->route('carts.index')->with('success', 'Songs purchased!');
  }

  public function index() {
    $transactions = Transaction::orderBy('status', 'DESC')
      ->paginate(10);

    return view('layout.transaction', compact('transactions'));
  }

  public function pendings(User $user) {
    $songs = Song::join('transaction_details', 'songs.id', '=', 'transaction_details.song_id')
      ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
      ->where('transactions.user_id', $user->id)
      ->where('transactions.status', '!=', 'approved')
      ->select('songs.*')
      ->distinct()
      ->paginate(7);

    $songs = Song::join('transaction_details', 'transaction_details.song_id', '=', 'songs.id')
      ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
      ->where('transactions.user_id', $user->id)
      ->where('transactions.status', 'pending')
      ->select('songs.*', 'transactions.status')
      ->distinct()
      ->paginate(7);

    return view('client.order', compact('user', 'songs'));
  }

  public function update(Transaction $transaction) {
    $transaction->update([
      'status' => request()->get('status', 'pending'),
    ]);

    return redirect()->route('transactions.index')->with('success', 'Status updated');
  }
}
