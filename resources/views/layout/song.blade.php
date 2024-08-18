@extends('layout.layout')

@section('content')
  <div class="musicse">
    @include('layout.navigation')
    <div class="ads text-center">
      <img src={{ asset('/img/032b0870b9053a191b67dc8c3f340345.gif') }} alt="">
    </div>
    <div class="content">
      @include('layout.add-music')
      <table class="table table-dark text-center">
        <thead>
          <tr>
            <th scope="col" style="color: rgb(19, 223, 97);">Album</th>
            <th scope="col" style="color: rgb(19, 223, 97);">Title</th>
            <th scope="col" style="color: rgb(19, 223, 97);">Artist</th>
            <th scope="col" style="color: rgb(19, 223, 97);">Duration</th>
            <th scope="col" style="color: rgb(19, 223, 97);">Price</th>
            <th scope="col" style="color: rgb(19, 223, 97);">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($songs as $song)
            <tr>
              <th scope="row">
                <img src="{{ $song->getImage() }}" alt="">
              </th>
              <td>{{ $song->title }}</td>
              <td>{{ $song->artist }}</td>
              <td>{{ $song->duration }}</td>
              <td>${{ number_format($song->price, 2) }}</td>
              @include('layout.song-action')
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">No songs available</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      {{ $songs->links() }}
    </div>
  </div>
@endsection

@if (auth()->check())
  @if (auth()->user()->user_type === 'incharge' || auth()->user()->user_type === 'admin')
    <!-- add music -->
    <div class="modal fade" id="addm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Song</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('songs.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <label for="image">Album image:</label>
              <input type="file" class="form-control" name="image" id="image" />
              <label for="title">Title:</label>
              <input type="text" class="form-control" id="title" name="title" />
              <label for="artist">Artist:</label>
              <input type="text" class="form-control" id="artist" name="artist" />
              <label for="duration">Duration:</label>
              <input type="text" class="form-control" id="duration" name="duration" />
              <label for="price">Price:</label>
              <input type="text" class="form-control" id="price" name="price" />
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endif
@endif
