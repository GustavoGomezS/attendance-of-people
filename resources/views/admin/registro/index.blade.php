@extends("theme.$theme.layout")
@section('titulo')
  Registro
@endsection

@section('contenido')
  <div class="row">
    <div class="col-lg-1">
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-12">
      <div class="card card-info card-outline">
        <div class="card-header h-25">
          @include('admin.registro.includes.formularioBusqueda')
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-3">
              <div id="datos"></div>
              <div id="datosVisitante"></div>
            </div>
            <div class="col-lg-9" id="datosRegistro"></div>
          </div>
          <form id="formulario" autocomplete="off" enctype="multipart/form-data">
            @include('admin.includes.modalFormulario', [
                'titulo' => 'Registro Nuevo',
                'formulario' => 'admin/registro/includes/formularioRegistro',
                'class' => 'modal-dialog ',
            ])
          </form>
          <button type="button" class="btn btn-info" id="opcionCrear" data-toggle="modal" data-target="#modal-lg">
            Ingreso
          </button>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
  @include('admin.includes.modalConfirmDelet')
@endsection
@section('scripts')
  <script>
    const url = {
      "guardar": "{{ route('registro.guardar') }}",
      "funcionarios": "{{ route('registro.funcionarios') }}",
      "registros": "{{ route('registro.registros') }}",
      "visitantes": "{{ route('registro.visitantes') }}",
      "puertas": "{{ route('registro.puertas') }}",
      "autoriza": "{{ route('registro.autoriza') }}",
      "ingresa": "{{ route('registro.ingresa') }}",
      "sectores": "{{ route('funcionario.sectores') }}",
      "localidades": "{{ route('funcionario.localidades') }}",
    }
  </script>
  <script src="{{ asset('assets/scripts/admin/registro/acciones.js') }}"></script>
  <script src="{{ asset('assets/scripts/admin/registro/listeners.js') }}"></script>
@endsection
