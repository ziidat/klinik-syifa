<nav class="main-header navbar navbar-expand navbar-olive navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
      @if (Auth::user()->admin === 1)
            <!-- Nav Item - Admin -->
            <li class="nav-item">
              <a class="nav-link" href="#" id="messagesDropdown" style="padding: 5px;">
                <span class="badge badge-danger">Admin</span>
              </a>
            </li>
            @endif
                
            <!-- Nav Item - Profesi -->
            <li class="nav-item">
              <a class="nav-link" href="#" id="messagesDropdown" style="padding: 5px;">
                <span class="badge badge-{{Auth::user()->profesi ? 'primary' :'warning'}}">{{Auth::user()->profesi}}</span>
              </a>    
            </li>
              
             <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown show">
              <a class="nav-link" href="#" data-toggle="dropdown">
                <i class="fas fa-bell fa-fw"></i>
                
                
                <!-- Counter - Alerts -->
                <span class="badge badge-danger navbar-badge">{{count(cek_stok_warning(10))}}</span>
                
              </a>
                @if ($notif=cek_stok_warning(10))
                @if (count($notif) > 0)
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                @foreach ($notif as $id => $pesan)
                <a class="dropdown-item d-flex align-items-center" href="{{route('obat.edit',$id)}}">
                  <div class="mr-3">
                    <div class="icon">
                      <i class="fas fa-capsules"></i>
                    </div>
                  </div>
                  <div>
                    <span class="font-weight-bold">{{$pesan}}</span>
                  </div>
                </a>
                    @endforeach
              </div>
            @endif
        @endif
            </li> 
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{ asset('storage/avatars') }}/{{ Auth::user()->avatar }}" class="user-image img-circle elevation-2" alt="User Image">
          <span class="color=white d-none d-md-inline">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-olive">
            <img src="{{ asset('storage/avatars') }}/{{ Auth::user()->avatar }}" class="img-circle elevation-2" alt="User Image">

            <p>
              {{ Auth::user()->name }}
              <small>{{ Auth::user()->profesi }}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
            <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
          </li>
        </ul>
      </li>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('index') }}" class="brand-link">
      <img src="{{ asset('img') }}/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
      <span class="brand-text font-weight-light">Klinik Syifa Medikana</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">MENU UTAMA</li>
            <li class="nav-item">
              <a href="{{ route('index') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>Dashboard</p>
              </a>
            </li>             
            <li class="nav-item">
              <a href="{{ route('pasien.index') }}" class="nav-link">
                <i class="nav-icon fas fa-user-injured"></i>
                <p>Pasien</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('rm') }}" class="nav-link">
                <i class="nav-icon fas fa-book-medical"></i>
                <p>Rekam Medis</p>
              </a>
            </li>
            @if (Auth::user()->profesi == "Petugas")
            <li class="nav-item">
              <a href="{{ route('obat.index') }}" class="nav-link">
                <i class="nav-icon fas fa-capsules"></i>
                <p>Obat</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('lab.index') }}" class="nav-link">
                <i class="nav-icon fas fa-flask"></i>
                <p>Lab</p>
              </a>
            </li>
            @else
          @endif
            @if (Auth::user()->admin == "1")
          <li class="nav-header">PENGATURAN</li>
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>Pengaturan Pengguna</p>
            </a>
            @else
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->