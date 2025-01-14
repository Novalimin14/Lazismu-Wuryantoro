@extends('layouts.app', [
    'namePage' => 'Table Report',
    'class' => 'sidebar-mini',
    'activePage' => 'laporan',
  ])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Edit Laporan</h4>
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

                    <form method="POST" action="{{ route('laporan.update', $data->id) }}">
                        @csrf
                        @method('PUT')
                        

                        <div class="form-group">
                            <label for="nama_muz">No Kwitansi</label>
                            <input type="text" class="form-control" id="kwitansi" name="kwitansi" value="{{ old('kwitansi',$data->kwitansi) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="nama_muz">Nama Muz</label>
                            <select class="form" name="status" id="status">
                            <option value="" >--- Nama Muzzaki ---</option>
                              @foreach ($namamuz as $nama)
                              <option value="{{ $nama->nama }}" >{{ $nama->nama }}</option>
                              {{ $nama->nama}}
                              @endforeach
                            
                            </select>
                            <input type="text" class="form-control" id="nama_muz" name="nama_muz" value="{{ old('nama_muz',$data->nama_muz) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="jml_dana">Jumlah Dana</label>
                            <input type="number" class="form-control" id="jml_dana" name="jml_dana" value="{{ old('jml_dana',$data->jml_dana) }}" >
                        </div>
                        <div class="form-group">
                            <label for="jml_beras">Jumlah Beras</label>
                            <input type="number" step="0.01" class="form-control" id="jml_beras" name="jml_beras" value="{{ old('jml_beras',$data->jml_beras) }}" >
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan',$data->keterangan) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal',$data->tanggal) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
        </div>
      </div>
      
        
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // Saat pilihan dalam dropdown berubah
        $('#status').change(function(){
            // Ambil nilai dari pilihan yang dipilih
            var selectedOption = $(this).val();
            // Masukkan nilai tersebut ke dalam input dengan id "muzzaki_id"
            $('#nama_muz').val(selectedOption);
            
        });
    });
</script>
@endsection