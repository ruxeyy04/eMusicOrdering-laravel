@if (auth()->check())
  @if (auth()->user()->user_type === 'incharge' || auth()->user()->user_type === 'admin')
    <div class="row">
      <div class="col-md-6">
        <h6>Available music</h6>
      </div>
      <div class="col-md-6 text-right mb-3">
        <button class="btn btn" data-target="#addm" data-toggle="modal">
          Add Music
        </button>
      </div>
    </div>
  @else
    <div class="row">
      <div class="col-md-6">
        <h6>Available music</h6>
      </div>
      <div class="col-md-6 text-right mb-3">
        <form action="{{ route('songs.index') }}" method="get">
          @csrf
          <input type="text" name="search">
          <select name="search_criteria">
            <option value="title">Title</option>
            <option value="artist">Artist</option>
          </select>
          <button type="submit" class="btn btn">
            Search
          </button>
        </form>
      </div>
    </div>
  @endif
@else
  <div class="row">
    <div class="col-md-6">
      <h6>Available music</h6>
    </div>
    <div class="col-md-6 text-right mb-3">
      <form action="{{ route('songs.index') }}" method="get">
        @csrf
        <input type="text" name="search">
        <select name="search_criteria">
          <option value="title">Title</option>
          <option value="artist">Artist</option>
        </select>
        <button type="submit" class="btn btn">
          Search
        </button>
      </form>
    </div>
  </div>
@endif
