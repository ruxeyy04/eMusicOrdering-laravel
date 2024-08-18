@extends('layout.layout')

@section('content')
  <div class="musicse">
    @include('layout.navigation')
    <div class="container">
      <div class="text-center">
        <button class="btn btn-info mt-3" data-toggle="modal" data-target="#editprof">
          Edit Profile
        </button>
      </div>
      <div class="row text-center">
        <div class="col-md-4"></div>
        <div class="col-md-4 mt-5" id="proffile">
          <img src="{{ $user->getImage() }}" alt="" />
          <h6 class="mt-3">{{ $user->first_name . ' ' . $user->last_name }}</h6>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4 mt-3">
          <label for="">Email:</label>
          <h6>{{ $user->email }}</h6>
        </div>
        <div class="col-md-4 mt-3">
          <label for="">Gender:</label>
          <h6>{{ $user->gender }}</h6>
        </div>
        <div class="col-md-4 mt-3">
          <label for="">Contact number:</label>
          <h6>{{ $user->contact_number }}</h6>
        </div>
      </div>
      @if (auth()->user()->user_type === 'client')
        <h6 class="mt-5">My Purchased Music</h6>
        <table class="table table-dark text-center">
          <thead>
            <tr>
              <th scope="col" style="color: rgb(19, 223, 97)">Album</th>
              <th scope="col" style="color: rgb(19, 223, 97)">Title</th>
              <th scope="col" style="color: rgb(19, 223, 97)">Artist</th>
              <th scope="col" style="color: rgb(19, 223, 97)">Duration</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($songs as $song)
              <tr>
                <th scope="row">
                  <img src="{{ $song->getImage() }}" alt="" />
                </th>
                <td>{{ $song->title }}</td>
                <td>{{ $song->artist }}</td>
                <td>{{ $song->duration }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">No songs purchased yet</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        {{ $songs->links() }}
      @endif
    </div>
  </div>
@endsection


<!-- updateprof -->
<div class="modal fade" id="editprof" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="modal-body">
          <input type="hidden" name="profile">
          <label for="image">Image</label>
          <input type="file" class="form-control" name="image" id="image">
          <label for="first_name">Fisrt name</label>
          <input type="text" class="form-control" name="first_name" id="first_name"
            value="{{ $user->first_name }}" />
          <label for="last_name">Last name</label>
          <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}" />
          <label for="contact_number">Contact number</label>
          <input type="text" class="form-control" name="contact_number" id="contact_number"
            value="{{ $user->contact_number }}" />
          <label for="gender">Gender</label>
          <input type="text" class="form-control" name="gender" id="gender" value="{{ $user->gender }}" />
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}" />
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password"
            placeholder="Enter new password if you wish to update it" />
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
