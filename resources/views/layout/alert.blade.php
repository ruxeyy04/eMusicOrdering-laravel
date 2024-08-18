<div id="alerts-container" style="position: absolute; top: 20px; left: 50%; transform: translateX(-50%);">
  @if (session('failed'))
    <div id="failed-alert" class="alert alert-danger alert-dismissible fade show position-relative" style="z-index: 1;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      {{ session('failed') }}
    </div>

    <script>
      setTimeout(function() {
        $("#failed-alert").alert('close');
      }, 5000);
    </script>
  @endif

  @if (session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show position-relative" style="z-index: 1;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      {!! nl2br(e(session('success'))) !!}
    </div>

    <script>
      setTimeout(function() {
        $("#success-alert").alert('close');
      }, 5000);
    </script>
  @endif

  @if ($errors->any())
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger alert-dismissible fade show position-relative" style="z-index: 1;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ $error }}
      </div>
    @endforeach
    <script>
      setTimeout(function() {
        $(".alert").alert('close');
      }, 5000);
    </script>
  @endif
</div>
