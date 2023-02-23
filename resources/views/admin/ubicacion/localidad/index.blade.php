@extends("theme.$theme.layout")
@section('titulo')
  Localidades
@endsection
@section('metadata')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}" />
  <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
@endsection
@section('contenido')
<div class="row">
  <div class="col-lg-12">
    <div class="card card-info card-outline">
      <div class="card-body">
        <div id="datos">
          <table id="tablaDatos" style="width:100%" class="table table-hover table-striped table-sm">
            <thead>
              <tr>
                <th colspan="4">
                  @include('admin.ubicacion.localidad.includes.formulario')
                </th>
              </tr>
              <tr>
                <th>id</th>
                <th>Sector</th>
                <th>Unidad</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@routes
  @include('admin.includes.modalConfirmDelet')
@endsection

@section('scripts')
  <script>
    const url = {
      "guardarLocalidad": "{{ route('localidad.guardar') }}",
      "localidades": "{{ route('localidad.listar') }}",
      "sectores": "{{ route('residente.sectores') }}",
    }
  </script>
  <script src="{{ asset('assets/scripts/admin/localidad/acciones.js') }}"></script>
  <script src="{{ asset('assets/scripts/admin/localidad/listeners.js') }}"></script>
@endsection
