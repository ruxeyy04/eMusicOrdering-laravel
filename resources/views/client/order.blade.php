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
            <th scope="col" style="color: rgb(19, 223, 97);">Status</th>
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
              <td>{{ $song->status }}</td>  
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">No songs available</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      {{ $songs->links() }}
    </div>
  </div>
@endsection
