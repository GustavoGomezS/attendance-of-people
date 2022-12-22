@extends("theme.$theme.layout")
@section('titulo')
Edificios y Puertas
@endsection
@section('metadata')
<meta name="csrf-token" content="{{csrf_token()}}"/> 
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-0">
          @include('admin/ubicacion/sectorPuerta/includes/formularioSector')
        </div>
        <div class="card-body table-responsive p-0">
          <div id="datosSector"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-0">
          @include('admin/ubicacion/sectorPuerta/includes/formularioPuerta')
        </div>
        <div class="card-body table-responsive p-0">
          <div id="datosPuerta"></div>
        </div>
      </div>
    </div>
  </div>
  @include('admin/includes/modalConfirmDelet')
  <form id="formularioSectorUpdate" method="post" autocomplete="off" class="form-inline">
  @include('admin/ubicacion/sectorPuerta/includes/modalFormulario')
  </form>
@endsection

@section('scripts')
<script>
const url = {
  "guardarSector": "{{route('sector.guardar')}}",
  "sectores": "{{route('sector.listar')}}",
  "guardarPuerta": "{{route('puerta.guardar')}}",
  "puertas": "{{route('puerta.listar')}}",
} 
</script>
<script src="{{asset("assets/scripts/admin/sectorPuerta/acciones.js")}}"></script>
<script src="{{asset("assets/scripts/AsyncFunction.js")}}"></script>
<script src="{{asset("assets/scripts/admin/sectorPuerta/listeners.js")}}"></script>
@endsection