@extends('layouts.app', [
    'namePage' => 'Edit Pembagian',
    'class' => 'sidebar-mini',
    'activePage' => 'phppembagian',
])

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Data Pembagian</h4>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('table_pembagian.update', $pembagian->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="pembagian">Pembagian</label>
                            <input type="text" name="pembagian" class="form-control" value="{{ $pembagian->pembagian }}" required>
                        </div>
                        <div class="form-group">
                            <label for="jml_dana">Jumlah Dana</label>
                            <input type="number" name="jml_dana" class="form-control" value="{{ $pembagian->jml_dana }}" >
                        </div>
                        <div class="form-group">
                            <label for="jml_beras">Jumlah Beras</label>
                            <input type="number" name="jml_beras" class="form-control" step="0.01" value="{{ $pembagian->jml_beras }}" >
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="{{ $pembagian->keterangan }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $pembagian->tanggal }}" required>
                        </div>
                        <div class="form-group">
                            <label for="mustahik">Mustahik</label>
                            <div class="checkbox-list">
                                @foreach($mustahiks as $mustahik)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="mustahik[]" value="{{ $mustahik->id }}"
                                                @if($pembagian->mustahiks->contains($mustahik->id)) checked @endif>
                                            {{ $mustahik->nama_mus }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
