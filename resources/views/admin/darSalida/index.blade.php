@extends("theme.$theme.layout")
@section('titulo')
Salida
@endsection
@section('metadata')
<link rel="stylesheet" type="text/css" href="{{asset("assets/DataTables/datatables.min.css")}}"/>
<script type="text/javascript" src="{{asset("assets/DataTables/datatables.min.js")}}"></script>
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-info card-outline">
        <div class="card-body">
          <div id="datos">
            <table id="tablaDatos" style="width:100%" class="table table-hover table-bordered">
              <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Documento</th>
                    <th>Sector - Unidad</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <button id="button" class="btn btn-info"  data-toggle="modal" data-target="#modal-lg">Dar Salida</button>
      </div>
    </div>
    <form id="formulario" autocomplete="off" enctype="multipart/form-data">
      @include('admin/darSalida/includes/modalFormulario')
    </form> 
  </div>
@endsection

@section('scripts')
<script>
const url = {
  "puertas": "{{route('registro.puertas')}}",
  "darSalida": "{{route('visitante.darSalida')}}",
  "visitantes": "{{route('visitante.dentro.buscar')}}",
  }
</script>
<script src="{{asset("assets/scripts/admin/darSalida/acciones.js")}}"></script>
<script src="{{asset("assets/scripts/AsyncFunction.js")}}"></script>
<script src="{{asset("assets/scripts/admin/darSalida/listeners.js")}}"></script>
@endsection