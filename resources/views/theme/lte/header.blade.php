<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <div class="container">
    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item" id="navItemIngresos">
          <a href="{{ route('registro.registro') }}" class="nav-link" id="navItemIngresosLink">Ingreso</a>
        </li>
        <li class="nav-item" id="navItemSalida">
          <a href="{{ route('darSalida.index') }}" class="nav-link" id="navItemSalidaLink">Salida</a>
        </li>
        <li class="nav-item" id="navItemFuncionarios">
          <a href="{{ route('estadoFuncionario.index') }}" class="nav-link" id="navItemFuncionariosLink">Funcionarios</a>
        </li>
        <li class="nav-item" id="navItemMinuta">
          <a href="{{ route('minuta.index') }}" class="nav-link" id="navItemMinutaLink">Minuta</a>
        </li>
        <li class="nav-item dropdown" id="navItemReporte">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Reporte</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <!-- Level two dropdown-->
            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" class="dropdown-item dropdown-toggle">Visitantes</a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li><a href="{{ route('reporte.index',['clave' => 'conNovedad']) }}" class="dropdown-item">Con Novedad </a></li>
                <li><a href="{{ route('reporte.index',['clave' => 'recinto']) }}" class="dropdown-item">Por Recinto</a></li>
                <li><a href="{{ route('reporte.index',['clave' => 'sector']) }}" class="dropdown-item">Por Sector</a></li>
                <li><a href="{{ route('reporte.index',['clave' => 'localidad']) }}" class="dropdown-item">Por Localidad</a></li>
                <li><a href="{{ route('reporte.index',['clave' => 'visitante']) }}" class="dropdown-item">Por Visitante</a></li>
              </ul>
            </li>
            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" class="dropdown-item dropdown-toggle">Funcionarios</a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li><a href="{{ route('reporte.index',['clave' => 'funcionario']) }}" class="dropdown-item">Ingreso y Salida</a></li>
                <li><a href="{{ route('reporte.index',['clave' => 'funcionarioTarde']) }}" class="dropdown-item">Llegada tarde</a></li>
              </ul>
            </li>
            <!-- End Level two -->          
          </ul>
        </li>
        <li class="nav-item" id="navItemEstadoActual">
          <a href="{{ route('estadoActual.index') }}" class="nav-link" id="navItemEstadoActualLink">Estado Actual</a>
        </li>
      </ul>
    </div>
    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      {{-- boton cerrar session --}}
      <li class="user-footer">
        <div class="pull-right">
          @auth
            <a class="btn" href="{{ route('login') }}"
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
      {{-- boton cerrar session fin --}}
    </ul>
  </div>
</nav>




