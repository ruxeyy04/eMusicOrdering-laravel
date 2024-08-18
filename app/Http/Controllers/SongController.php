<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller {
  public function index() {
    $user = User::find(auth()->id());
    $search = request()->input('search');
    $searchCriteria = request()->input('search_criteria', 'title');

    $query = Song::orderBy('title', 'ASC');

    if ($search) {
      if ($searchCriteria == 'artist') {
        $query->where('artist', 'like', "%$search%");
      } else {
        $query->where('title', 'like', "%$search%");
      }
    }

    if (auth()->check() && auth()->user()->user_type === 'client') {
      $songs = $query
        ->select('songs.*')
        ->leftJoin('carts', function ($join) use ($user) {
          $join->on('songs.id', '=', 'carts.song_id')
            ->where('carts.user_id', '=', $user->id);
        })
        ->leftJoin('transaction_details', function ($join) use ($user) {
          $join->on('songs.id', '=', 'transaction_details.song_id')
            ->leftJoin('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->where('transactions.user_id', '=', $user->id);
        })
        ->orderByRaw('
                ISNULL(transaction_details.id) DESC,
                ISNULL(carts.id) DESC,
                songs.created_at DESC
            ')
        ->paginate(7);
    } else {
      $songs = $query->paginate(7);
    }

    return view('layout.song', compact('songs', 'user'));
  }



  public function store() {
    $validated = request()->validate([
      'image' => 'image|nullable',
      'title' => 'required',
      'artist' => 'required',
      'duration' => ['regex:/^\d+:\d{2}$/'],
      'price' => 'required|numeric',
    ], [
      'duration.regex' => 'The duration must be in minute format ex.0:59.',
    ]);

    if (request()->hasFile('image')) {
      $image = request()->file('image');
      $imagePath = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('song'), $imagePath);
      $validated['image'] = $imagePath;
    }

    Song::create($validated);

    return redirect()->route('songs.index')->with('success', 'Song added');
  }

  public function update(Song $song) {
    // dd(request()->all());
    $validated = request()->validate([
      'image' => 'image|nullable',
      'title' => 'required',
      'artist' => 'required',
      'duration' => ['regex:/^\d+:\d{2}$/'],
      'price' => 'required|numeric',
    ], [
      'duration.regex' => 'The duration must be in minute format ex.0:59.',
    ]);

    if (request()->hasFile('image')) {
      $image = request()->file('image');
      $imagePath = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('song'), $imagePath);
      $validated['image'] = $imagePath;

      if ($song->image) {
        $existingImagePath = public_path('song') . '/' . $song->image;
        if (file_exists($existingImagePath)) {
          unlink($existingImagePath);
        }
      }
    }

    $song->update($validated);

    return redirect()->route('songs.index')->with('success', 'Music updated');
  }

  public function destroy(Song $song) {
    $song->delete();

    if ($song->image) {
      $existingImagePath = public_path('song') . '/' . $song->image;
      if (file_exists($existingImagePath)) {
        unlink($existingImagePath);
      }
    }

    return redirect()->route('songs.index')->with('success', 'Music deleted');
  }
}
