@if (!auth()->check())
  <div class="navig">
    <div class="row">
      <div class="col-md-2">
        <h4 class="text-center font-weight-bold">e<span style="color: rgb(19, 223, 97);">Music</span></h4>
      </div>
      <div class="col-md-8">
        <h6 class="text-center font-weight-bold" style="font-size:small; padding-top: 3px;">Home
      </div>
      <div class="col-md-2 text-center">
        <a href="{{ route('songs.index') }}"><i class="fa-solid fa-house fa-lg text-center"></i></a>
        <a href="{{ route('login') }}"><i class="fa-solid fa-arrow-up fa-lg text-center"><span
              style="font-size: x-small;"></span></i></a>
      </div>
    </div>
  </div>
@else
  @if (auth()->user()->user_type === 'client')
    <div class="navig">
      <div class="row">
        <div class="col-md-2">
          <h4 class="text-center font-weight-bold">
            e<span style="color: rgb(19, 223, 97)">Music</span>
          </h4>
        </div>
        <div class="col-md-8">
          <h6 class="text-center font-weight-bold" style="font-size: small; padding-top: 3px">
            Home
          </h6>
        </div>
        <div class="col-md-2 text-center">
          <a href="{{ route('songs.index') }}"><i class="fa-solid fa-house fa-lg text-center"></i></a>
          <a href="{{ route('carts.index') }}"><i class="fa-solid fa-cart-shopping fa-lg text-center"></i></a>
          <a href="{{ route('pendings.index', Auth::user()->id) }}"><i class="fa-solid fa-spinner fa-lg text-center"></i></a>
          <a href="{{ route('users.show', Auth::user()->id) }}"><i class="fa-solid fa-user fa-lg text-center"></i></a>
          <a href="" data-toggle="modal" data-target="#logout"><i
              class="fa-solid fa-right-from-bracket fa-lg text-center"></i></a>
        </div>
      </div>
    </div>
  @elseif (auth()->user()->user_type === 'incharge')
    <div class="navig">
      <div class="row">
        <div class="col-md-2">
          <h4 class="text-center font-weight-bold">
            e<span style="color: rgb(19, 223, 97)">Music</span>
          </h4>
        </div>
        <div class="col-md-8">
          <h6 class="text-center font-weight-bold" style="font-size: small; padding-top: 3px">
            Home
          </h6>
        </div>
        <div class="col-md-2 text-center">
          <a href="{{ route('songs.index') }}"><i class="fa-solid fa-house fa-lg text-center"></i></a>
          <a href="{{ route('transactions.index') }}"><i class="fa-solid fa-money-bill fa-lg text-center"></i></a>
          <a href="{{ route('users.index', ['user_type' => 'client']) }}"><i
              class="fa-solid fa-users fa-lg text-center"></i></a>
          <a href="{{ route('users.show', Auth::user()->id) }}"><i class="fa-solid fa-user fa-lg text-center"></i></a>
          <a href="" data-toggle="modal" data-target="#logout"><i
              class="fa-solid fa-right-from-bracket fa-lg text-center"></i></a>
        </div>
      </div>
    </div>
  @elseif (auth()->user()->user_type === 'admin')
    <div class="navig">
      <div class="row">
        <div class="col-md-2">
          <h4 class="text-center font-weight-bold">
            e<span style="color: rgb(19, 223, 97)">Music</span>
          </h4>
        </div>
        <div class="col-md-7">
          <h6 class="text-center font-weight-bold" style="font-size: small; padding-top: 3px">
            Home
          </h6>
        </div>
        <div class="col-md-3 text-center">
          <a href="{{ route('songs.index') }}"><i class="fa-solid fa-house fa-lg text-center"></i></a>
          <a href="{{ route('transactions.index') }}"><i class="fa-solid fa-money-bill fa-lg text-center"></i></a>
          <a href="{{ route('users.index', ['user_type' => 'client']) }}"><i class="fa-solid fa-users fa-lg text-center"></i></a>
          <a href="{{ route('users.index', ['user_type' => 'incharge']) }}"><i class="fa-solid fa-user-tie fa-lg text-center"></i></a>
          <a href="{{ route('users.show', Auth::user()->id) }}"><i class="fa-solid fa-user fa-lg text-center"></i></a>
          <a href="" data-toggle="modal" data-target="#logout"><i
              class="fa-solid fa-right-from-bracket fa-lg text-center"></i></a>
        </div>
      </div>
    </div>
  @endif
@endif
