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
            <h4 class="card-title"> Edit Mustahik</h4>
          </div>
          <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('table_mustahik.update', $data->id) }}">
                        @csrf
                        @method('PUT')
                        

                        

                        <div class="form-group">
                            <label for="nama_mus">Nama Mustahik</label>
                            <input type="text" class="form-control" id="nama_mus" name="nama_mus" value="{{ old('nama_mus', $data->nama_mus) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $data->alamat) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="ktp">Nomor KTP</label>
                            <input type="text" class="form-control" id="ktp" name="ktp" value="{{ old('ktp', $data->ktp) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jkl" id="jkl_laki" value="Laki-laki" {{ old('jkl', $data->jkl) === 'Laki-laki' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jkl_laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jkl" id="jkl_perempuan" value="Perempuan" {{ old('jkl', $data->jkl) === 'Perempuan' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jkl_perempuan">Perempuan</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $data->pekerjaan) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="jns_mus">Jenis Mustahik</label>
                            <input type="text" class="form-control" id="jns_mus" name="jns_mus" value="{{ old('jns_mus', $data->jns_mus) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tipe_mus">Tipe Mustahik</label>
                            <input type="text" class="form-control" id="tipe_mus" name="tipe_mus" value="{{ old('tipe_mus', $data->tipe_mus) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="KTM">Kartu Tanda Mahasiswa</label>
                            <input type="text" class="form-control" id="KTM" name="KTM" value="{{ old('KTM', $data->KTM) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="spres">Surat Prestasi</label>
                            <input type="text" class="form-control" id="spres" name="spres" value="{{ old('spres', $data->spres) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="Skel">Surat Kelurahan (Usaha)</label>
                            <input type="text" class="form-control" id="Skel" name="Skel" value="{{ old('Skel', $data->Skel) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="Sktm">Surat Keterangan Tidak Mampu</label>
                            <input type="text" class="form-control" id="Sktm" name="Sktm" value="{{ old('Sktm', $data->Sktm) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="sprem">Surat Pernyataan Kesanggupan</label>
                            <input type="number" class="form-control" id="sprem" name="sprem" value="{{ old('sprem', $data->sprem) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="gaji">Gaji</label>
                            <input type="text" class="form-control" id="gaji" name="gaji" value="{{ old('gaji', $data->gaji) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="status_2">Status (Keluarga) Mustahik</label>
                            <input type="text" class="form-control" id="status_2" name="status_2" value="{{ old('status_2', $data->status_2) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan', $data->keterangan) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $data->tanggal) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="link_maps">Link Maps</label>
                            <input type="text" class="form-control" id="link_maps" name="link_maps" value="{{ old('link_maps', $data->link_maps) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
        </div>
      </div>
      
        
      </div>
    </div>
  </div>
@endsection