@extends('layouts.app', [
    'namePage' => 'Tambah Penyaluran',
    'class' => 'sidebar-mini',
    'activePage' => 'pembagian',
])

@section('content')
<style>
    .checkbox-list {
        display: flex;
        flex-wrap: wrap;
    }

    .checkbox {
        flex-basis: 20%; /* Mengatur lebar setiap checkbox agar 20% dari container */
        margin-bottom: 10px; /* Mengatur jarak antara checkbox */
    }

    @media (max-width: 768px) {
        .checkbox {
            flex-basis: 50%; /* Mengatur lebar setiap checkbox menjadi 50% ketika lebar layar kurang dari 768px */
        }
    }
</style>
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Data Penyaluran</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('table_pembagian.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="pembagian">Pembagian</label>
                            <input type="text" name="pembagian" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jml_dana">Jumlah Dana</label>
                            <input type="number" name="jml_dana" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="jml_beras">Jumlah Beras(Kg)</label>
                            <input type="number" name="jml_beras" class="form-control" step="0.01" >
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mustahik">Mustahik</label>
                            <div class="checkbox-list">
                                @foreach($mustahiks as $mustahik)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="mustahik[]" value="{{ $mustahik->id }}">
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
