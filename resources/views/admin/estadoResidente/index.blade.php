@extends("theme.$theme.layout")
@section('titulo')
  Estado de Residentes
@endsection
@section('metadata')
  <script src={{ asset('assets/zoom-master/jquery.zoom.js') }}></script>
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-info card-outline">
        <div class="card-body">
          @foreach ($datos as $colorSector => $localidad)
            <div class="mt-1 text-center">
              @foreach ($localidad as $id => $nombreLocalidad)
                <a data-toggle="modal" data-target="#modal-lg" class="btn buscar" id="{{ $id }}"
                  style="background-color: {{ $colorSector }};color:white;"
                  href="{{ route('estadoResidente.residentes', $id) }}">
                  {{ $nombreLocalidad }}
                </a>
              @endforeach
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @include('admin/estadoResidente/includes/modalFormulario')
@endsection

@section('scripts')
  <script>
    const url = {
      "update": "{{ route('estadoResidente.update') }}"
    }
  </script>
  <script src="{{ asset('assets/scripts/admin/estadoResidente/acciones.js') }}"></script>
  <script src="{{ asset('assets/scripts/admin/estadoResidente/listeners.js') }}"></script>
@endsection
