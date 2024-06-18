@extends('layouts.app', [
  'namePage' => 'users',
  'class' => 'sidebar-mini',
  'activePage' => 'users',
])

@section('content')

  <!-- End Navbar --> <div class="panel-header">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-primary btn-round text-white pull-right" href="#">Add user</a>
            <h4 class="card-title">Users</h4>
            <div class="col-12 mt-2">
                                        </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Profile</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Creation date</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Profile</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Creation date</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </tfoot>
              <tbody>
                    <tr>
                    <td>
                    <span class="avatar avatar-sm rounded-circle">
                    <img src="{{asset('assets')}}/img/default-avatar.png" alt="" style="max-width: 80px; border-radius: 100px">
                    </span>
                    </td>
                    <td>Admin</td>
                    <td>admin@nowui.com</td>
                    <td>25/02/2020 10:14</td>
                      <td class="text-right">
                        <a type="button" href="#" rel="tooltip" class="btn btn-success btn-icon btn-sm " data-original-title="" title="">
                        <i class="now-ui-icons ui-2_settings-90"></i>
                      </a>
                    </td>
                  </tr>
                  
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