@extends('layouts.app', [
    'namePage' => 'Table Muzzaki',
    'class' => 'sidebar-mini',
    'activePage' => 'muzzaki',
  ])
  <style>
    .table .text-right .row {
    display: flex; 
    justify-content: flex-end; 
    gap: 10px; /* Jarak antar tombol */
  }

  .table .text-right .btn {
      margin: 0; /* Menghapus margin default jika ada */
  }
  </style>

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Data Muzzaki</h4>
          </div>
          <div class="card-body">
            <a href="/muzzaki/create" class="btn btn-primary">Tambah Data</a>
            <a href="/muzzaki/export-pdf" class="btn btn-primary">Export Data</a>
            <form action="" method="GET">
              <div class="form-group">
                  <label for="search">Search:</label>
                  <input type="text" name="search" id="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
              </div>
              <div class="form-group">
                <label for="perPage">Show:</label>
                <select name="perPage" id="perPage" class="form-control">
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
              <button type="submit" class="btn btn-primary mt-3">Filter</button>
              

            </form>
            <div class="table-responsive">
            @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif  
            <table class="table">
                <thead class=" text-primary">
                  <th>
                    No
                  </th>  
                  <th>
                    Nama
                  </th>
                  <th>
                    Alamat
                  </th>
                  <th>
                    KTP
                  </th>
                  <th>
                    Jenis Kelamin
                  </th>
                  <th>
                    Pekerjaan
                  </th>
                  <th>
                  Link Maps
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
                    {{ $item->nama }}
                    </td>
                    <td>
                    {{ $item->alamat }}
                    </td>
                    <td>
                    {{ $item->ktp }}
                    </td>
                    <td>
                    {{ $item->jkl }}
                    </td>
                    <td>
                    {{ $item->pekerjaan }}
                    </td>
                    <td>
                    {{ $item->linkmaps }}
                    </td>
                    <td class="text-right">
                      <div class="row">
                        <a href="/muzzaki/{{ $item->id }}" class="btn btn-info btn-sm btn-icon" role="button" aria-pressed="true">
                        <i class="now-ui-icons users_single-02"></i>
                        </a>

                        <a href="/muzzaki/{{ $item->id }}/edit" class="btn btn-success btn-sm btn-icon" role="button" aria-pressed="true">
                            <i class="now-ui-icons ui-2_settings-90"></i>
                        </a>

                        <form action="{{ route('muzzaki.destroy', $item->id) }}" method="POST">
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
          </div>
        </div>
      </div>
      <div class="col-md-12">
        
      </div>
    </div>
  </div>
@endsection