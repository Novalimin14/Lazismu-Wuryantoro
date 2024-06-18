@extends('layouts.app', [
    'namePage' => 'Table Muzzaki',
    'class' => 'sidebar-mini',
    'activePage' => 'muzzaki',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> DETAIL DATA MUZZAKI {{ $data->nama }}</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}" readonly>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $data->alamat }}" readonly>
            </div>

            <div class="form-group">
                <label for="ktp">KTP</label>
                <input type="text" class="form-control" id="ktp" name="ktp" value="{{ $data->ktp }}" readonly>
            </div>

            <div class="form-group">
                <label for="jkl">Jenis Kelamin</label>
                <input type="text" class="form-control" id="jkl" name="jkl" value="{{ $data->jkl }}" readonly>
            </div>

            <div class="form-group">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ $data->pekerjaan }}" readonly>
            </div>

            <div class="form-group">
                <label for="linkmaps">Link Maps</label>
                <input type="text" class="form-control" id="linkmaps" name="linkmaps" value="{{ $data->linkmaps }}" readonly>
            </div>

            <a href="{{ route('muzzaki.index') }}" class="btn btn-primary">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
