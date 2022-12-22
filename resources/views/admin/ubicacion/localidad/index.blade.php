@extends("theme.$theme.layout")
@section('titulo')
  Localidades
@endsection
@section('metadata')
  <meta name="csrf-token" content="{{csrf_token()}}"/> 
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header border-0">
          @include('admin/ubicacion/localidad/includes/formulario')
        </div>
        <div class="card-body table-responsive p-0">
          <div id="datos"></div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
  @include('admin/includes/modalConfirmDelet')
@endsection

@section('scripts')
  <script>
    const url = {
      "guardarLocalidad": "{{route('localidad.guardar')}}",
      "localidades": "{{route('localidad.listar')}}",
      "sectores": "{{route('localidad.sectores')}}",
    } 
  </script>
  <script src="{{asset("assets/scripts/admin/localidad/acciones.js")}}"></script>
  <script src="{{asset("assets/scripts/AsyncFunction.js")}}"></script>
  <script src="{{asset("assets/scripts/admin/localidad/listeners.js")}}"></script>
@endsection