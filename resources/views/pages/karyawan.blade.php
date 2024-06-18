@extends('layouts.app', [
  'namePage' => 'karyawan',
  'class' => 'sidebar-mini',
  'activePage' => 'karyawan',
])

@section('content')

  <!-- End Navbar --> <div class="panel-header">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('karyawan.create') }}">Add user</a>
            <h4 class="card-title">Users</h4>
            <div class="col-12 mt-2">
                                        </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>Profile</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Creation date</th>
                  <th class="text-right">Actions</th>
                </tr>
              </thead>
              
              <tbody>
                    
                  @foreach($data as $item) 
                  <tr>
                    <td>
                    <span class="avatar avatar-sm rounded-circle">
                    <img src="{{asset('assets')}}/img/default-avatar.png" alt="" style="max-width: 80px; border-radius: 100px">
                    </span>
                    </td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    
                    <td>{{ $item->created_at }}</td>
                    <td class="text-left">
                        <div class="row">
                            <a type="button" href="{{ route('karyawan.edit', $item->id) }}" rel="tooltip" class="btn btn-success btn-icon btn-sm " data-original-title="" title="">
                            <i class="now-ui-icons ui-2_settings-90"></i>
                            </a>
                            <form action="{{ route('karyawan.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm btn-icon" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
                                <i class="now-ui-icons ui-1_simple-remove"></i> 
                              </button>
                            </form>      
                        </div>
                    </td>
                        
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
      <!-- end col-md-12 -->
    </div>
    
    <!-- end row -->
  </div>
    </div>                    </div>
  
  @stack('js')
</body>

</html>
@endsection