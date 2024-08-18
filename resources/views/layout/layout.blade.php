<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href={{ asset('css/style.css') }} />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/b15d9bd0c0.js" crossorigin="anonymous"></script>
  <title>{{ config('app.name') }}</title>
</head>

<body>
  @include('layout.alert')
  <section>
    @yield('content')
  </section>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>



<!-- register -->
<div class="modal fade" id="reg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <label for="image">Image</label>
          <input type="file" class="form-control" name="image" id="image">
          <label for="first_name">First name</label>
          <input type="text" class="form-control" name="first_name" id="first_name" />
          <label for="last_name">Last name</label>
          <input type="text" class="form-control" name="last_name" id="last_name" />
          <label for="contact_number">Contact number</label>
          <input type="text" class="form-control" name="contact_number" id="contact_number" />
          <label for="">Gender</label>
          <select name="gender" class="form-control">
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" id="email" />
          <label for="password">Password</label>
          <input type="text" class="form-control" name="password" id="password" />
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

@if (auth()->check())
  <!-- logout -->
  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6>Are you sure you want to logout?</h6>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <form action="{{ route('logout') }}" method="get">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endif
