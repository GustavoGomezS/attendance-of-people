 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <div class="container">

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item">
            <a href="{{route('registro.registro')}}" class="nav-link">Ingreso</a>
          </li>
          <li class="nav-item">
            <a href="{{route('visitante.dentro')}}" class="nav-link">Salida</a>
          </li>
          <li class="nav-item">
            <a href="{{route('estadoResidente.index')}}" class="nav-link">Residentes</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Registros</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Con Novedad </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>
              <li class="dropdown-divider"></li>
              <!-- Level two dropdown-->
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Filtrado por</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li><a href="#" class="dropdown-item">Recinto</a></li>
                  <li><a href="#" class="dropdown-item">Sector</a></li>
                  <li><a href="#" class="dropdown-item">Localidad</a></li>
                  <li><a href="#" class="dropdown-item">Visitante</a></li>
                  <!-- Level three dropdown-->
                  <li class="dropdown-submenu">
                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Persona</a>
                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                      <li><a href="#" class="dropdown-item">Residente</a></li>
                      <li><a href="#" class="dropdown-item">Visitante</a></li>
                    </ul>
                  </li>
                  <!-- End Level three -->


                </ul>
              </li>
              <!-- End Level two -->
            </ul>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        {{-- boton cerrar session --}}
        <li class="user-footer">
          <div class="pull-right">
            @auth
              <a class="dropdown-item btn btn-default btn-flat" href="{{ route('login') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    {{ __('Cerrar sesión') }}
              </a>  
            @endauth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </li>
        {{-- boton cerrar session fin--}}
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->