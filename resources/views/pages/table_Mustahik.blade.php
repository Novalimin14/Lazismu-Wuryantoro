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
            <h4 class="card-title"> DATA Mustahik</h4>
          </div>
          <div class="card-body">
            
            <a href="/table_mustahik/create" class="btn btn-primary">Tambah Data</a>
            <a href="{{ route('table_mustahik.export.pdf') }}" class="btn btn-primary">Export Data</a>
            <form action="" method="GET">
              <div class="form-group">
                  <label for="search">Search:</label>
                  <input type="text" name="search" id="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
              </div>
              <!--  -->
              <div class="form-row">
                  
                  <div class="col">
                    <label for="bulan_awal">Bulan Awal:</label>
                    <select name="bulan_awal" id="bulan_awal" class="form-control">
                        <option value="">Pilih Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" @if(request('bulan_awal') == $i) selected @endif>{{ sprintf("%02d", $i) }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col">
                    <label for="bulan_akhir">Bulan Akhir:</label>
                    <select name="bulan_akhir" id="bulan_akhir" class="form-control">
                        <option value="">Pilih Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" @if(request('bulan_akhir') == $i) selected @endif>{{ sprintf("%02d", $i) }}</option>
                        @endfor
                    </select>
                </div>
                  <div class="col">
                      <label for="tahun">Tahun:</label>
                      <select name="tahun" id="tahun" class="form-control">
                          <option value="">Pilih Tahun</option>
                          @for ($i = date('Y'); $i >= 2010; $i--)
                              <option value="{{ $i }}" @if(request('tahun') == $i) selected @endif>{{ $i }}</option>
                          @endfor
                      </select>
                  </div>
              </div>
              <button type="submit" class="btn btn-primary mt-3">Filter</button>
            </form>
            <div class="form-group">
                <label for="perPage">Show:</label>
                <select name="perPage" id="perPage" class="form-control">
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>

            <div class="table-responsive">
              

              <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
                @endif

                <table class="table">
                <thead class=" text-primary">
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Nomor KTP</th>
                      <th>Jenis Kelamin</th>
                      <th>Pekerjaan</th>
                      <th>Jenis Muzzaki</th>
                      <th>Tipe Muzzaki</th>
                      <th class="text-right">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $item)
                    <tr>
                    <td>
                    {{ $loop->iteration }}
                    </td>
                      <td>{{ $item->nama_mus }}</td>
                      <td>{{ $item->alamat }}</td>
                      <td>{{ $item->ktp }}</td>
                      <td>{{ $item->jkl }}</td>
                      <td>{{ $item->pekerjaan }}</td>
                      <td>{{ $item->jns_mus }}</td>
                      <td>{{ $item->tipe_mus }}</td>
                      <td class="text-right">
                        <div class="row">
                        <a href="/table_mustahik/{{ $item->id }}" class="btn btn-info btn-sm btn-icon" role="button" aria-pressed="true">
                          <i class="now-ui-icons users_single-02"></i>
                        </a>

                        <a href="{{ route('table_mustahik.edit', $item->id) }}" class="btn btn-success btn-sm btn-icon" role="button" aria-pressed="true">
                          <i class="now-ui-icons ui-2_settings-90"></i>
                        </a>

                        <form action="{{ route('table_mustahik.destroy', $item->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm btn-icon" onclick="return confirm('Apakah anda ingin menghapus data {{ $item->nama_mus }}?')">
                              <i class="now-ui-icons ui-1_simple-remove"></i> 
                          </button>                   
                        </form>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $data->links() }}
              </div>
              
              <div>
              <div>
              
            </div>
            
          </div>
        </div>
      </div>
      
    </div>
  </div>
@endsection
