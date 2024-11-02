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
                            <label for="jns_mus">Tipe Mustahik</label>
                            <select class="form-control" id="jns_mus" name="jns_mus" readonly>
                                <option value="Fakir" {{ old('jns_mus',$data->jns_mus) == 'Fakir' ? 'selected' : '' }}>Fakir</option>
                                <option value="Miskin" {{ old('jns_mus',$data->jns_mus) == 'Miskin' ? 'selected' : '' }}>Miskin</option>
                                <option value="Amil" {{ old('jns_mus',$data->jns_mus) == 'Amil' ? 'selected' : '' }}>Amil</option>
                                <option value="Muallaf" {{ old('jns_mus',$data->jns_mus) == 'Muallaf' ? 'selected' : '' }}>Muallaf</option>
                                <option value="Riqab" {{ old('jns_mus',$data->jns_mus) == 'Riqab' ? 'selected' : '' }}>Riqab</option>
                                <option value="Gharim" {{ old('jns_mus',$data->jns_mus) == 'Gharim' ? 'selected' : '' }}>Gharim</option>
                                <option value="Fisabilillah" {{ old('jns_mus',$data->jns_mus) == 'Fisabilillah' ? 'selected' : '' }}>Fisabilillah</option>
                                <option value="Ibnu Sabil" {{ old('jns_mus',$data->jns_mus) == 'Ibnu Sabil' ? 'selected' : '' }}>Ibnu Sabil</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="tipe_mus">Subtipe Mustahik</label>
                            <select class="form-control" id="tipe_mus" name="tipe_mus" readonly>
                                <option value="Tipe 1" {{ old('tipe_mus',$data->tipe_mus) == 'Tipe 1' ? 'selected' : '' }}>Tipe 1</option>
                                <option value="Tipe 2" {{ old('tipe_mus',$data->tipe_mus) == 'Tipe 2' ? 'selected' : '' }}>Tipe 2</option>
                                <option value="Tipe 3" {{ old('tipe_mus',$data->tipe_mus) == 'Tipe 3' ? 'selected' : '' }}>Tipe 3</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="KTM">Kartu Tanda Mahasiswa</label>
                            <select class="form-control" id="KTM" name="KTM" readonly>
                                <option value="Ada" {{ old('KTM',$data->KTM) == 'Ada' ? 'selected' : '' }}>Ada</option>
                                <option value="Tidak" {{ old('KTM',$data->KTM) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="spres">Surat Prestasi</label>
                            <select class="form-control" id="spres" name="spres" readonly>
                                <option value="Ada" {{ old('spres',$data->spres) == 'Ada' ? 'selected' : '' }}>Ada</option>
                                <option value="Tidak" {{ old('spres',$data->spres) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Skel">Surat Kelurahan (Usaha)</label>
                            <select class="form-control" id="Skel" name="Skel" readonly>
                                <option value="Ada" {{ old('Skel',$data->Skel) == 'Ada' ? 'selected' : '' }}>Ada</option>
                                <option value="Tidak" {{ old('Skel',$data->Skel) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Sktm">Surat Keterangan Tidak Mampu</label>
                            <select class="form-control" id="Sktm" name="Sktm" readonly>
                                <option value="Ada" {{ old('Sktm',$data->Sktm) == 'Ada' ? 'selected' : '' }}>Ada</option>
                                <option value="Tidak" {{ old('Sktm',$data->Sktm) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sprem">Surat Pernyataan Kesanggupan</label>
                            <select class="form-control" id="sprem" name="sprem" readonly>
                                <option value="Ada" {{ old('sprem',$data->sprem) == 'Ada' ? 'selected' : '' }}>Ada</option>
                                <option value="Tidak" {{ old('sprem',$data->sprem) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
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

            <!-- <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $data->tanggal }}" readonly>
            </div> -->

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
