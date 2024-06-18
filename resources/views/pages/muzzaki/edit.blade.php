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
            <h4 class="card-title"> EDIT DATA MUZZAKI {{ $data->nama }}</h4>
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

                    <form method="POST" action="{{ route('muzzaki.update', $data->id) }}">
                        @csrf
                        @method('PUT')
                        

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $data->alamat }}" required>
                        </div>

                        <div class="form-group">
                            <label for="ktp">KTP</label>
                            <input type="text" class="form-control" id="ktp" name="ktp" value="{{ $data->ktp }}}" required>
                        </div>

                        <div class="form-group">
                            <label for="jkl">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jkl" name="jkl" value="{{ $data->jkl }}" required>
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ $data->pekerjaan }}" required>
                        </div>

                        <div class="form-group">
                            <label for="linkmaps">Link Maps</label>
                            <input type="text" class="form-control" id="linkmaps" name="linkmaps" value="{{ $data->linkmaps }}" required>
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