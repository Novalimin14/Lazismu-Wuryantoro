@extends('layouts.app', [
    'namePage' => 'Data Pembagian',
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
            <h4 class="card-title"> Data Pembagian</h4>
          </div>
          <div class="card-body">
          <a href="/pembagian/create" class="btn btn-primary">Tambah Data</a>
          <a href="/pembagian/export-pdf" class="btn btn-primary">export Data</a>
          <form action="" method="GET">
              <div class="form-group">
                  <label for="search">Search:</label>
                  <input type="text" name="search" id="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
              </div>
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
              <div class="form">
                <label for="perPage">Show:</label>
                <select name="perPage" id="perPage" class="form-control">
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
          </form>
          @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif  

            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                <th>
                    No
                  </th>  
                <th>
                    Pembagian
                  </th>
                  <th>
                    Jumlah
                  </th>
                  <th>
                    Keterangan
                  </th>
                  <th>
                    Tanggal
                  </th>
                  
                  <th class="text-right">
                    Action
                  </th>
                </thead>
                <tbody>
                @foreach ($data as $item)
                  <tr>
                    <td>
                    {{ $loop->iteration }}
                    </td>
                    <td>
                    {{ $item->pembagian }}
                    </td>
                    <td>
                    {{ $item->jml_dana }}
                    </td>
                    <td>
                    {{ $item->keterangan }}
                    </td>
                    <td>
                    {{ $item->tanggal }}
                    </td>
                   
                    <td class="text-right">
                    <div class="row text-right">
                    <a href="/pembagian/{{ $item->id }}" class="btn btn-info btn-sm btn-icon" role="button" aria-pressed="true">
                    <i class="now-ui-icons users_single-02"></i>
                    </a>

                    <a href="/pembagian/{{ $item->id }}/edit" class="btn btn-success btn-sm btn-icon" role="button" aria-pressed="true">
                        <i class="now-ui-icons ui-2_settings-90"></i>
                    </a>

                    
                    <form action="{{ route('pembagian.destroy', $item->id) }}" method="POST">
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
              @if($data->isNotEmpty() && $data->hasPages())
              {{ $data->appends(request()->except('page'))->links() }}
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card card-plain">
          
          
        </div>
      </div>
    </div>
  </div>
@endsection