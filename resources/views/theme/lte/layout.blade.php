<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('titulo', 'ProyectoDeGrado')</title>
  <!-- jQuery  -->
  <script src="{{ asset("assets/$theme/plugins/jquery/jquery.min.js") }}"></script>
  @yield('metadata')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset("assets/$theme/plugins/fontawesome-free/css/all.min.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("assets/$theme/dist/css/adminlte.min.css") }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @yield('styles')
</head>

<body class="sidebar-mini layout-fixed control-sidebar-slide-open text-sm" style="height: auto;">
  <div class="wrapper">
    <!--inicio header -->
    @include("theme/$theme/header")
    <!--fin header -->
    <!--inicio aside -->
    @include("theme/$theme/aside")
    <!--fin aside -->
    <div class="content-wrapper">
      <section class="content">
        @yield('contenido')
        <div class="row">
      </section>
    </div>
    <!-- Inicio footer-->
    {{-- @include("theme/$theme/footer") --}}
    <!--fin footer -->
  </div>
  <!-- Bootstrap 4 -->
  <script src="{{ asset("assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
  <script src="{{ asset("assets/$theme/plugins/select2/js/select2.full.min.js") }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset("assets/$theme/dist/js/adminlte.min.js") }}"></script>
  <!-- toastr -->
  <script src="{{ asset("assets/$theme/plugins/toastr/toastr.min.js") }}"></script>
  {{-- clases para funciones asyncronas --}}
  <script src="{{ asset('assets/scripts/AsyncFunction.js') }}"></script>
  <script>
    $(document).on("click", "nav ul li", function() {
      if ($('a:first', this).hasClass("active")) {
        $('a:first', this).removeClass("active");
      } else {
        $('a:first', this).addClass("active");
      }
    });
  </script>
  @yield('scripts')
</body>

</html>
