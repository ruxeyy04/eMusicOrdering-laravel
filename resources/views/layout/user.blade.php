@extends('layout.layout')

@section('content')
  <div class="musicse">
    @include('layout.navigation')
    <div class="row">
      <div class="cartt col-md-12">
        <div class="content">
          <div class="row">
            <div class="col-md-6">
              @if ($userType === 'client')
                <h6>List of all clients</h6>
              @else
                <h6>List of all incharge</h6>
              @endif
            </div>
            <div class="col-md-6 text-right mb-3">
              <button class="btn btn" data-target="#addm" data-toggle="modal">
                @if ($userType === 'client')
                  Add Client
                @else
                  Add Incharge
                @endif
              </button>
            </div>
          </div>

          <table class="table table-dark text-center">
            <thead>
              <tr>
                <th scope="col" style="color: rgb(19, 223, 97)">User ID</th>
                <th scope="col" style="color: rgb(19, 223, 97)">Image</th>
                <th scope="col" style="color: rgb(19, 223, 97)">First name</th>
                <th scope="col" style="color: rgb(19, 223, 97)">Last name</th>
                <th scope="col" style="color: rgb(19, 223, 97)">Email</th>
                <th scope="col" style="color: rgb(19, 223, 97)">Contact number</th>
                <th scope="col" style="color: rgb(19, 223, 97)">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
                <tr>
                  <th scope="row">{{ $user->id }}</th>
                  <td><img src="{{ $user->getImage() }}" alt="" /></td>
                  <td>{{ $user->first_name }}</td>
                  <td>{{ $user->last_name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->contact_number }}</td>
                  <td>
                    <button class="btn btn-warning" data-target="#editm{{ $user->id }}" data-toggle="modal">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-danger" data-target="#remove{{ $user->id }}" data-toggle="modal">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </td>
                </tr>

                <!-- edit user -->
                <div class="modal fade normal" id="editm{{ $user->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                          <input type="hidden" name="{{ $userType }}">
                          <label for="image">Image</label>
                          <input type="file" class="form-control" name="image" id="image">
                          <label for="first_name">Fisrt name</label>
                          <input type="text" class="form-control" name="first_name" id="first_name"
                            value="{{ $user->first_name }}" />
                          <label for="last_name">Last name</label>
                          <input type="text" class="form-control" name="last_name" id="last_name"
                            value="{{ $user->last_name }}" />
                          <label for="contact_number">Contact number</label>
                          <input type="text" class="form-control" name="contact_number" id="contact_number"
                            value="{{ $user->contact_number }}" />
                          <label for="gender">Gender</label>
                          <input type="text" class="form-control" name="gender" id="gender"
                            value="{{ $user->gender }}" />
                          <label for="email">Email</label>
                          <input type="text" class="form-control" name="email" id="email"
                            value="{{ $user->email }}" />
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

                <!-- remove -->
                <div class="modal fade" id="remove{{ $user->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h6>Are you sure you want to delete this user?</h6>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                          Close
                        </button>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <input type="hidden" name="{{ $userType }}">
                          <button type="submit" class="btn btn-danger">Yes</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              @empty
                <tr>
                  <td colspan="7" class="text-center">No users</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

<!-- add user -->
<div class="modal fade" id="addm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="{{ $userType }}">
          <label for="image">Image</label>
          <input type="file" class="form-control" name="image" id="image">
          <label for="first_name">Fisrt name</label>
          <input type="text" class="form-control" name="first_name" id="first_name" />
          <label for="last_name">Last name</label>
          <input type="text" class="form-control" name="last_name" id="last_name" />
          <label for="contact_number">Contact number</label>
          <input type="text" class="form-control" name="contact_number" id="contact_number" />
          <label for="gender">Gender</label>
          <input type="text" class="form-control" name="gender" id="gender" />
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" id="email" />
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" />
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn">Add User</button>
        </div>
      </form>
    </div>
  </div>
</div>
