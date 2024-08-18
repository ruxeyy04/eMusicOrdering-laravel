<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Administrators {
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response {
    $allowedUserTypes = ['incharge', 'admin'];

    if (!in_array(auth()->user()->user_type, $allowedUserTypes)) {
      abort(403);
    }

    return $next($request);
  }
}
