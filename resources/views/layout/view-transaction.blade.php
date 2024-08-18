<!-- view -->
<div class="modal fade normal" id="view{{ $transaction->id }}" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Purchase</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('transactions.update', $transaction->id) }}" method="post">
        @csrf
        @method('put')
        <div class="modal-body">
          <label>Order ID:</label>
          <input type="text" class="form-control" disabled placeholder="{{ $transaction->id }}" />
          <label>Music:</label>
          <div class="row">
            @foreach ($transaction->transactionDetails as $transactionDetails)
              <div class="col-md-4 mb-4">
                <div class="card">
                  <img src="{{ $transactionDetails->song->getImage() }}" class="card-img-top" alt="Song Image">
                  <div class="card-body">
                    <h5 class="card-title">{{ $transactionDetails->song->title }}</h5>
                    <p class="card-text">Artist: {{ $transactionDetails->song->artist }}</p>
                    <p class="card-text">Price: ${{ number_format($transactionDetails->song->price, 2) }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <hr class="line" />
          <h6>ORDER SUMMARY</h6>
          <div class="row">
            <div class="col-md-6"><label for="">Total</label></div>
            <div class="col-md-6 text-right">
              <h6>
                ${{ number_format(
                    $transaction->transactionDetails->sum(function ($detail) {
                        return $detail->song->price;
                    }),
                    2,
                ) }}
              </h6>
            </div>
          </div>
          <hr class="line" />
          <div class="row">
            <div class="col">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <option value="approved" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Approved</option>
                <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-info">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
