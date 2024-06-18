@extends('layouts.app', [
    'namePage' => 'Table Mustahik',
    'class' => 'sidebar-mini',
    'activePage' => 'table_mustahik',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Detail Mustahik</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
                <label for="nama_mus">Nama Mustahik</label>
                <input type="text" class="form-control" id="nama_mus" name="nama_mus" value="{{ $data->nama_mus }}" readonly>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $data->alamat }}" readonly>
            </div>

            <div class="form-group">
                <label for="ktp">Nomor KTP</label>
                <input type="text" class="form-control" id="ktp" name="ktp" value="{{ $data->ktp }}" readonly>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label><br>
                <input type="text" class="form-control" id="jkl" name="jkl" value="{{ $data->jkl }}" readonly>
            </div>

            <div class="form-group">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ $data->pekerjaan }}" readonly>
            </div>

            <div class="form-group">
                <label for="jns_mus">Jenis Mustahik</label>
                <input type="text" class="form-control" id="jns_mus" name="jns_mus" value="{{ $data->jns_mus }}" readonly>
            </div>

            <div class="form-group">
                <label for="tipe_mus">Tipe Mustahik</label>
                <input type="text" class="form-control" id="tipe_mus" name="tipe_mus" value="{{ $data->tipe_mus }}" readonly>
            </div>

            <div class="form-group">
                <label for="KTM">Kartu Tanda Mahasiswa</label>
                <input type="text" class="form-control" id="KTM" name="KTM" value="{{ $data->KTM }}" readonly>
            </div>

            <div class="form-group">
                <label for="spres">Surat Prestasi</label>
                <input type="text" class="form-control" id="spres" name="spres" value="{{ $data->spres }}" readonly>
            </div>

            <div class="form-group">
                <label for="Skel">Surat Kelurahan (Usaha)</label>
                <input type="text" class="form-control" id="Skel" name="Skel" value="{{ $data->Skel }}" readonly>
            </div>

            <div class="form-group">
                <label for="Sktm">Surat Keterangan Tidak Mampu</label>
                <input type="text" class="form-control" id="Sktm" name="Sktm" value="{{ $data->Sktm }}" readonly>
            </div>

            <div class="form-group">
                <label for="sprem">Surat Pernyataan Kesanggupan</label>
                <input type="number" class="form-control" id="sprem" name="sprem" value="{{ $data->sprem }}" readonly>
            </div>

            <div class="form-group">
                <label for="gaji">Gaji</label>
                <input type="text" class="form-control" id="gaji" name="gaji" value="{{ $data->gaji }}" readonly>
            </div>

            <div class="form-group">
                <label for="status_2">Status (Keluarga) Mustahik</label>
                <input type="text" class="form-control" id="status_2" name="status_2" value="{{ $data->status_2 }}" readonly>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $data->keterangan }}" readonly>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $data->tanggal }}" readonly>
            </div>

            <div class="form-group">
                <label for="link_maps">Link Maps</label>
                <input type="text" class="form-control" id="link_maps" name="link_maps" value="{{ $data->link_maps }}" readonly>
            </div>

            <a href="{{ route('table_mustahik.index') }}" class="btn btn-primary">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
