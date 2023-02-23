@extends("theme.$theme.layout")
@section('titulo')
  Salida
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
        <div class="card-footer">
          <button id="button" class="btn btn-info col-lg-12" data-toggle="modal" data-target="#modal-lg">Dar Salida</button>
        </div>
        
      </div>
    </div>
    <form id="formulario" autocomplete="off" enctype="multipart/form-data">
      @include('admin.includes.modalFormulario', [
          'titulo' => 'Confirmar Salida',
          'formulario' => 'admin/darSalida/includes/formularioRegistro',
          'class' => 'modal-dialog ',
      ])
    </form>
  </div>
@endsection

@section('scripts')
  <script>
    const url = {
      "puertas": "{{ route('registro.puertas') }}",
      "darSalida": "{{ route('darSalida.darSalida') }}",
      "visitantes": "{{ route('darSalida.visitantes') }}",
    }
  </script>
  <script src="{{ asset('assets/scripts/admin/darSalida/acciones.js') }}"></script>
  <script src="{{ asset('assets/scripts/admin/darSalida/listeners.js') }}"></script>
@endsection
