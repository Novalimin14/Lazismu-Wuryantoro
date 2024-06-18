@extends('layouts.app', [
    'namePage' => 'Table Report',
    'class' => 'sidebar-mini',
    'activePage' => 'laporan',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Detail Laporan</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
                <label for="kwitansi">No Kwitansi</label>
                <input type="text" class="form-control" id="kwitansi" name="kwitansi" value="{{ $data->kwitansi }}" readonly>
            </div>

            <div class="form-group">
                <label for="nama_muz">Nama Muzzaki</label>
                <input type="text" class="form-control" id="nama_muz" name="nama_muz" value="{{ $data->nama_muz }}" readonly>
            </div>

            <div class="form-group">
                <label for="jml_dana">Jumlah Dana</label>
                <input type="number" class="form-control" id="jml_dana" name="jml_dana" value="{{ $data->jml_dana }}" readonly>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $data->keterangan }}" readonly>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $data->tanggal }}" readonly>
            </div>

            <a href="{{ route('laporan.index') }}" class="btn btn-primary">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
