<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
  use AuthorizesRequests, ValidatesRequests;

  public function index() {
    return redirect()->route('songs.index');
  }

  public function login() {
    return view('guest.login');
  }

  public function authenticate() {
    $validated = request()->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (auth()->attempt($validated)) {
      request()->session()->regenerate();
      
      return redirect()->route('songs.index')->with('success', 'User logged in!');
    } else {
      return redirect()->route('login')->with('failed', 'Invalid email or password');
    }
  }

  public function logout() {
    auth()->logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('songs.index')->with('success', 'Logged out successfully');
  }
}
