@extends('layout.layout')

@section('content')
  <div class="musicse">
    @include('layout.navigation')
    <div class="row">
      <div class="cartt col-md-10">
        <h6>CART</h6>
        <table class="table table-dark text-center">
          <thead>
            <tr>
              <th scope="col" style="color: rgb(19, 223, 97)">Album</th>
              <th scope="col" style="color: rgb(19, 223, 97)">Title</th>
              <th scope="col" style="color: rgb(19, 223, 97)">Artist</th>
              <th scope="col" style="color: rgb(19, 223, 97)">Duration</th>
              <th scope="col" style="color: rgb(19, 223, 97)">Price</th>
              <th scope="col" style="color: rgb(19, 223, 97)">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($carts as $cart)
              <tr>
                <th scope="row">
                  <img src="{{ $cart->song->getImage() }}" alt="" />
                </th>
                <td>{{ $cart->song->title }}</td>
                <td>{{ $cart->song->artist }}</td>
                <td>{{ $cart->song->duration }}</td>
                <td>$ {{ number_format($cart->song->price, 2) }}</td>
                <td>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#remove{{ $cart->id }}">
                    Remove
                  </button>
                </td>
              </tr>

              <!-- remove   -->
              <div class="modal fade" id="remove{{ $cart->id }}" tabindex="-1" role="dialog"
                aria-labelledby="removeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content" style="color: black">
                    <div class="modal-header">
                      <h5 class="modal-title" id="removeModalLabel">Remove Music</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h6>Are you sure you want to remove this music?</h6>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="{{ route('carts.destroy', $cart->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Remove</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <tr>
                <td colspan="6" class="text-center">
                  Nothing in cart
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="os col-md-2">
        @php
          $cartPrice = $carts->sum(function ($cart) {
              return $cart->song->price;
          });
        @endphp
        <h6>ORDER SUMMARY</h6>
        <div class="row">
          <div class="col-md-6"><label>Price</label></div>
          <div class="col-md-6 text-right">
            @forelse ($carts as $cart)
              <h6>$ {{ number_format($cart->song->price, 2) }}</h6>
            @empty
              <h6>$ 0.00</h6>
            @endforelse
          </div>
          <div class="col-md-12">
            <hr class="line" />
          </div>
          <div class="col-md-6"><label for="">Total</label></div>
          <div class="col-md-6 text-right">
            <h6>$ {{ number_format($cartPrice, 2) }}</h6>
          </div>
          <div class="col-md-12 text-right mt-3">
            @if ($carts->isEmpty())
              <button class="btn btn-info" data-target="#placeorder" data-toggle="modal" disabled>Order Song/s</button>
            @else
              <form action="{{ route('transactions.store') }}" method="post">
                @csrf
                @foreach ($carts as $cart)
                  <input type="hidden" name="song_ids[]" value="{{ $cart->song->id }}">
                @endforeach
                <button type="submit" class="btn btn-info" data-target="#placeorder" data-toggle="modal">Order Song/s</button>
              </form>
            @endif
          </div>
        </div>
      </div>
    </div>
    {{ $carts->links() }}
  </div>
  </section>
@endsection
