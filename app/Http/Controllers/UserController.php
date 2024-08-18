<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
  public function store() {
    $validated = request()->validate([
      'image' => 'image|nullable',
      'first_name' => 'required',
      'last_name' => 'required',
      'contact_number' => 'required|digits:11',
      'gender' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required'
    ]);

    $validated['user_type'] = 'client';
    if (request()->has('incharge')) {
      $validated['user_type'] = 'incharge';
    }

    if (request()->hasFile('image')) {
      $image = request()->file('image');
      $imagePath = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('profile'), $imagePath);
      $validated['image'] = $imagePath;
    }

    User::create($validated);

    if (auth()->check()) {
      if (request()->has('client')) {
        return redirect()->route('users.index', ['user_type' => 'client'])->with('success', 'Client added');
      }
      return redirect()->route('users.index', ['user_type' => 'incharge'])->with('success', 'Incharge added');
    } else {
      return redirect()->route('login')->with('success', 'User registered!');
    }
  }

  public function show(User $user) {
    $songs = Song::join('transaction_details', 'songs.id', '=', 'transaction_details.song_id')
      ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
      ->where('transactions.user_id', $user->id)
      ->where('transactions.status', 'approved')
      ->select('songs.*')
      ->distinct()
      ->paginate(3);
    return view('layout.profile', compact('user', 'songs'));
  }

  public function update(User $user) {
    // dd(request()->all());
    $validated = request()->validate([
      'image' => 'image|nullable',
      'first_name' => 'required',
      'last_name' => 'required',
      'contact_number' => 'required|digits:11',
      'gender' => 'required',
      'email' => [
        'required',
        'email',
        Rule::unique('users', 'email')->ignore($user->id),
      ],
    ]);

    if (request()->get('password') != null) {
      $validated['password'] = request()->get('password');
    }

    if (request()->hasFile('image')) {
      $image = request()->file('image');
      $imagePath = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('profile'), $imagePath);
      $validated['image'] = $imagePath;

      if ($user->image) {
        $existingImagePath = public_path('profile') . '/' . $user->image;
        if (file_exists($existingImagePath)) {
          unlink($existingImagePath);
        }
      }
    }

    $user->update($validated);

    if (request()->has('profile')) {
      return redirect()->route('users.show', $user->id)->with('success', 'Profile updated');
    }

    if (request()->has('client')) {
      return redirect()->route('users.index', ['user_type' => 'client'])->with('success', 'Client updated');
    }

    return redirect()->route('users.index', ['user_type' => 'incharge'])->with('success', 'Incharge updated');
  }

  public function index() {
    $userType = request()->get('user_type', 'client');

    $users = User::where('user_type', $userType)->paginate(10);

    return view('layout.user', compact('users', 'userType'));
  }

  public function destroy(User $user) {
    $user->delete();

    if ($user->image) {
      $existingImagePath = public_path('profile') . '/' . $user->image;
      if (file_exists($existingImagePath)) {
        unlink($existingImagePath);
      }
    }

    if (request()->has('client')) {
      return redirect()->route('users.index', ['user_type' => 'client'])->with('success', 'Client deleted');
    }
    return redirect()->route('users.index', ['user_type' => 'incharge'])->with('success', 'Incharge deleted');
  }
}
