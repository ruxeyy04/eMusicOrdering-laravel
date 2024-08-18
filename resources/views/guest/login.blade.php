@extends('layout.layout')

@section('content')
  <div class="musicse">
    @include('layout.navigation')
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4"></div>
        <div class="col-md-4" id="logg">
          <h4 class="mt-5 font-weight-bold">
            Login e<span style="color: rgb(19, 223, 97)">Music</span>
          </h4>
          <hr class="line" />
          <form action="{{ route('authenticate') }}" class="log" method="get">
            @csrf
            <label class="mt-3" for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" />
            <label class="mt-3" for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" />
            <button type="submit" class="btn btn-info mt-3">Login</button>
          </form>
          <p class="mt-3">
            Don't have an account?
            <span class="reg" data-toggle="modal" data-target="#reg">Register here!</span>
          </p>
          <hr class="line" />
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>
@endsection
