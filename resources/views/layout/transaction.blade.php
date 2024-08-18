@extends('layout.layout')

@section('content')
  <div class="musicse">
    @include('layout.navigation')
    <div class="row">
      <div class="cartt col-md-12">
        <h6>List of purchase</h6>
        <table class="table table-dark text-center">
          <thead>
            <tr>
              <th scope="col" style="color: rgb(19, 223, 97)">Order ID</th>
              <th scope="col" style="color: rgb(19, 223, 97)">Name</th>
              <th scope="col" style="color: rgb(19, 223, 97)">
                Total Music
              </th>
              <th scope="col" style="color: rgb(19, 223, 97)">
                Total Price
              </th>
              <th scope="col" style="color: rgb(19, 223, 97)">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($transactions as $transaction)
              <tr>
                <th scope="row">{{ $transaction->id }}</th>
                <td>{{ $transaction->user->first_name . ' ' . $transaction->user->last_name }}</td>
                <td>{{ $transaction->transactionDetails->count() }}</td>
                <td>
                  ${{ number_format(
                      $transaction->transactionDetails->sum(function ($detail) {
                          return $detail->song->price;
                      }),
                      2,
                  ) }}
                </td>
                <td>
                  <button class="btn btn-info" data-target="#view{{ $transaction->id }}" data-toggle="modal">
                    <i class="fa-solid fa-eye">{{ $transaction->status }}</i>
                  </button>
                </td>
              </tr>
              @include('layout.view-transaction')
            @empty
              <tr>
                <td colspan="5">No transactions</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        {{ $transactions->links() }}
      </div>
    </div>
  </div>
@endsection
