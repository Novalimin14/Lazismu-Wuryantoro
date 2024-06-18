<!-- resources/views/pages/edit_karyawan.blade.php -->

@extends('layouts.app', [
  'namePage' => 'Edit Karyawan',
  'class' => 'sidebar-mini',
  'activePage' => 'karyawan',
])

@section('content')
<div class="panel-header">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Edit Karyawan</h5>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('karyawan.update', $karyawan->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" name="nama" class="form-control" value="{{ $karyawan->nama }}" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" value="{{ $karyawan->email }}" required>
            </div>
            <div class="form-group">
              <label for="password">Password (Leave blank if not changing)</label>
              <input type="password" name="password" id="password" class="form-control" value="{{ $karyawan->password_plain }}">
            </div>
            <div class="">
              <input type="checkbox" class="" id="showPassword">
              <label class="form-check-label" for="showPassword">Show Password</label>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
document.getElementById('showPassword').addEventListener('change', function() {
    var passwordInput = document.getElementById('password');
    if (this.checked) {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
});
</script>

@endsection

