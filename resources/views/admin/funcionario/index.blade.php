@extends("theme.$theme.layout")
@section('titulo')
  Funcionarios
@endsection
@section('metadata')
  <script src="{{ asset("assets/$theme/plugins/bs-custom-file-input/bs-custom-file-input.js") }}"></script>
  <script src="{{ asset('assets/scripts/admin/documentos/validarArchivo.js') }}"></script>
  <script src="{{ asset('assets/scripts/admin/documentos/mostrarFoto.js') }}"></script>
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-1">
    </div>
    <div class="col-lg-12">
      <div class="card card-info card-outline">
        <div class="card-header h-25">
          @include('admin.funcionario.includes.formularioBusqueda')
        </div>
        <div class="card-body">
          <div id="datos"></div>
          <form id="formulario" autocomplete="off" enctype="multipart/form-data">
            @include('admin.includes.modalFormulario', [
                'titulo' => 'Nuevo funcionario',
                'formulario' => 'admin/funcionario/includes/formularioRegistro',
                'class' => 'modal-dialog modal-lg modal-dialog-scrollable',
            ])
          </form>
          @can('esAdmin')
          <button type="button" class="btn btn-info" id="opcionCrear" data-toggle="modal" data-target="#modal-lg">
            Nuevo Funcionario
          </button>
          @endcan
        </div>
      </div>
    </div>
  </div>
  @include('admin.includes.modalConfirmDelet')
@endsection

@section('scripts')
  <script>
    const url = {
      "guardar": "{{ route('funcionario.guardar') }}",
      "funcionario": "{{ route('funcionario.listar') }}",
      "sectores": "{{ route('funcionario.sectores') }}",
      "localidades": "{{ route('funcionario.localidades') }}",
    }
  </script>
  <script src="{{ asset('assets/scripts/admin/funcionario/acciones.js') }}"></script>
  <script src="{{ asset('assets/scripts/admin/funcionario/listeners.js') }}"></script>
@endsection
