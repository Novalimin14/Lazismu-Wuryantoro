@extends('layouts.app', [
    'namePage' => 'Detail Pembagian',
    'class' => 'sidebar-mini',
    'activePage' => 'pembagian',
])

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Data Pembagian</h4>
                </div>
                <div class="card-body">
                    <p><strong>Pembagian:</strong> {{ $pembagian->pembagian }}</p>
                    <p><strong>Jumlah Dana:</strong> {{ $pembagian->jml_dana }}</p>
                    <p><strong>Jumlah Beras:</strong> {{ $pembagian->jml_beras }}</p>
                    <p><strong>Keterangan:</strong> {{ $pembagian->keterangan }}</p>
                    <p><strong>Tanggal:</strong> {{ $pembagian->tanggal }}</p>
                    <p><strong>Mustahik:</strong></p>
                    <ul>
                        @foreach($pembagian->mustahiks as $mustahik)
                        <li>{{ $mustahik->nama_mus }}</li>
                        @endforeach
                    </ul>
                    <a href="/table_pembagian" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
