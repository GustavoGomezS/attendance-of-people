@extends("theme.$theme.layout")
@section('titulo')
visitantes
@endsection
@section('metadata')
<script src="{{asset("assets/$theme/plugins/bs-custom-file-input/bs-custom-file-input.js")}}"></script>
<meta name="csrf-token" content="{{csrf_token()}}"/> 
<script src="{{asset("assets/scripts/admin/documentos/validarArchivo.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/documentos/mostrarFoto.js")}}"></script> 
@endsection

@section('contenido')
  <div class="row">
    <div class="col-lg-1">
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-12">
      <div class="card card-info card-outline">
        <div class="card-header h-25">
            @include('admin/visitante/includes/formularioBusqueda')
        </div>
        <div class="card-body">
          <div id="datos"></div>
          <form id="formulario" autocomplete="off" enctype="multipart/form-data">
            @include('admin/visitante/includes/modalFormulario')
          </form> 
          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
          <button type="button" class="btn btn-info" id="opcionCrear" data-toggle="modal" data-target="#modal-lg">
            Nuevo visitante
          </button>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
  @include('admin/includes/modalConfirmDelet')
@endsection

@section('scripts')
<script>
  const url = {
    "guardar": "{{route('visitante.guardar')}}",
    "visitantes": "{{route('visitante.listar')}}",
  }
</script>
<script src="{{asset("assets/scripts/admin/visitante/acciones.js")}}"></script>
<script src="{{asset("assets/scripts/AsyncFunction.js")}}"></script>
<script src="{{asset("assets/scripts/admin/visitante/listeners.js")}}"></script>
@endsection