<aside class="main-sidebar elevation-4 sidebar-light-olive">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src={{asset("assets/$theme/dist/img/AdminLTELogo.png")}} alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src={{asset("assets/$theme/dist/img/user2-160x160.jpg")}}  class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            @auth
              {{ auth()->user()->name}}
              {{ auth()->user()->lastName}}
            @endauth
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
{{--       <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item" id="personasLi">
            <a href="#" class="nav-link" id="personasA">
              <i class="nav-icon fas fa-people-arrows"></i>
              <p>
                Personas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('residente')}}" class="nav-link" id="residentes">
                  <i class="fas fa-user-check nav-icon"></i>
                  
                  <p>Residentes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('visitante')}}" class="nav-link" id="visitantes">
                  <i class="fas fa-user-friends nav-icon"></i>
                  <p>Visitantes</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item" id="ubicacionesLi">
            <a href="#" class="nav-link" id="ubicacionesA">
              <i class="nav-icon fa fa-building" aria-hidden="true"></i>
              <p>
                Ubicaciones
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">2</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('sectorPuerta')}}" class="nav-link" id="entradasEdificios">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sectores y Puertas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('localidad')}}" class="nav-link" id="localidad">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Localidad</p>
                </a>
              </li>

            </ul>
          </li>   
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  