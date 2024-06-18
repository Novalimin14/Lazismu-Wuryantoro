<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    
    </a>
    <a href="" class="simple-text logo-normal">
      {{ __('LAZISMU WURYANTORO') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="@if ($activePage == 'home') active @endif">
        <a href="{{ route('home') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li>
        <a data-toggle="collapse" href="#laravelExamples">
            <i class="now-ui-icons users_single-02"></i>
          <p>
            {{ __("User and Admin") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExamples">
          <ul class="nav">
            <li class="@if ($activePage == 'profile') active @endif">
              <a href="{{ route('profile.edit') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("User Profile") }} </p>
              </a>
            </li>
            
            <li class = " @if ($activePage == 'karyawan') active @endif">
              <a href="{{ route('page.index','karyawan') }}">
                <i class="now-ui-icons users_circle-08"></i>
                <p>{{ __('Karyawan') }}</p>
              </a>
            </li>
          </ul>
        </div>
     
      <li class = " @if ($activePage == 'table_mustahik') active @endif">
        <a href="{{ route('page.index','table_mustahik') }}">
          <i class="now-ui-icons design_bullet-list-67"></i>
          <p>{{ __('Data Mustahik') }}</p>
        </a>
      </li>
      <li class = " @if ($activePage == 'muzzaki') active @endif">
        <a href="{{ route('page.index','muzzaki') }}">
          <i class="now-ui-icons design_bullet-list-67"></i>
          <p>{{ __('Data Muzzaki') }}</p>
        </a>
      </li>
      <li class = " @if ($activePage == 'laporan') active @endif">
        <a href="{{ route('page.index','laporan') }}">
          <i class="now-ui-icons files_single-copy-04"></i>
          <p>{{ __('laporan') }}</p>
        </a>
      </li>
      <li class = " @if ($activePage == 'pengeluaran') active @endif">
        <a href="{{ route('page.index','pengeluaran') }}">
          <i class="now-ui-icons business_money-coins"></i>
          <p>{{ __('pengeluaran') }}</p>
        </a>
      </li>
      <li class = " @if ($activePage == 'pembagian') active @endif">
        <a href="{{ route('page.index','pembagian') }}">
          <i class="now-ui-icons files_paper"></i>
          <p>{{ __('pembagian') }}</p>
        </a>
      </li>
      
      
    </ul>
  </div>
</div>
