@extends('layouts.app', [
    'namePage' => 'Table Report',
    'class' => 'sidebar-mini',
    'activePage' => 'pengeluaran',
  ])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> DATA pengeluaran</h4>
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

                    <form method="POST" action="{{ route('pengeluaran.store') }}">
                        @csrf
                        @method('POST')
                        

                        <div class="form-group">
                            <label for="pengeluaran">Pengeluaran </label>
                            <input type="text" class="form-control" id="pengeluaran" name="pengeluaran" value="{{ old('pengeluaran') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="jml_dana">Jumlah Dana</label>
                            <input type="number" class="form-control" id="jml_dana" name="jml_dana" value="{{ old('jml_dana') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
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