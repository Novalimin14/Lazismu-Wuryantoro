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
            <h4 class="card-title"> DATA MUZZAKI</h4>
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

                    <form method="POST" action="{{ route('muzzaki.store') }}">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="ktp">KTP</label>
                            <input type="text" class="form-control" id="ktp" name="ktp" value="{{ old('ktp') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jkl" id="jkl_laki" value="Laki-laki" {{ old('jkl') === 'Laki-laki' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jkl_laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jkl" id="jkl_perempuan" value="Perempuan" {{ old('jkl') === 'Perempuan' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jkl_perempuan">Perempuan</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="linkmaps">Link Maps</label>
                            <input type="text" class="form-control" id="linkmaps" name="linkmaps" value="{{ old('linkmaps') }}" required>
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