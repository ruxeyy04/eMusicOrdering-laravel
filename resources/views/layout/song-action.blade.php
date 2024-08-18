<td>
  @if (!auth()->check())
    <button class="btn btn" disabled>Add to cart</button>
  @else
    @if (auth()->user()->user_type === 'client')
      @php
        $songInCart = $user->carts->contains('song_id', $song->id);
        $songPurchased = false;
        $songPending = false;

        foreach ($user->transactions as $transaction) {
            if ($transaction->transactionDetails->contains('song_id', $song->id) && $transaction->status === 'pending') {
                $songPending = true;
                break;
            } elseif ($transaction->transactionDetails->contains('song_id', $song->id) && $transaction->status === 'approved') {
                $songPurchased = true;
                break;
            }
        }
      @endphp

      @if ($songInCart)
        <button class="btn btn-warning" disabled>Already in cart</button>
      @elseif ($songPurchased)
        <button class="btn btn-info" disabled>Song purchased</button>
      @elseif ($songPending)
        <button class="btn btn-secondary" disabled>Song pending</button>
      @else
        <form action="{{ route('carts.store', ['song_id' => $song->id]) }}" method="post">
          @csrf
          <button type="submit" class="btn btn">Add to cart</button>
        </form>
      @endif
    @else
      <button class="btn btn-warning" data-target="#editm{{ $song->id }}" data-toggle="modal">
        <i class="fa-solid fa-pen-to-square"></i>
      </button>
      <button class="btn btn-danger" data-target="#remove{{ $song->id }}" data-toggle="modal">
        <i class="fa-solid fa-trash"></i>
      </button>

      <div class="text-left normal">
        <!-- edit music -->
        <div class="modal fade" id="editm{{ $song->id }}" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Music</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('songs.update', $song->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body">
                  <label for="image">Album image:</label>
                  <input type="file" class="form-control" name="image" id="image"
                    value="{{ $song->getImage() }}" />
                  <label for="title">Title:</label>
                  <input type="text" class="form-control" id="title" name="title"
                    value="{{ $song->title }}" />
                  <label for="artist">Artist:</label>
                  <input type="text" class="form-control" id="artist" name="artist"
                    value="{{ $song->artist }}" />
                  <label for="duration">Duration:</label>
                  <input type="text" class="form-control" id="duration" name="duration"
                    value="{{ $song->duration }}" />
                  <label for="price">Price:</label>
                  <input type="text" class="form-control" id="price" name="price"
                    value="{{ number_format($song->price, 2) }}" />
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                  </button>
                  <button type="submit" class="btn btn-info">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- remove -->
        <div class="modal fade" id="remove{{ $song->id }}" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove Music</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h6>Are you sure you want to remove this music?</h6>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                  Close
                </button>
                <form action="{{ route('songs.destroy', $song->id) }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger">Remove</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  @endif
</td>
