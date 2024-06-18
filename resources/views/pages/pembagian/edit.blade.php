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
                            <input type="number" name="jml_dana" class="form-control" value="{{ $pembagian->jml_dana }}" required>
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
                            <select name="mustahik[]" class="form-control" multiple>
                                @foreach($mustahiks as $mustahik)
                                    <option value="{{ $mustahik->id }}" @if(in_array($mustahik->id, $pembagian->mustahiks->pluck('id')->toArray())) selected @endif>{{ $mustahik->nama_mus }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
