@extends("theme.$theme.layout")
@section('titulo')
  {{$datos["tituloPagina"]}}
@endsection
@section('metadata')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}" />
  <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.1.2/chart.umd.js" integrity="sha512-t41WshQCxr9T3SWH3DBZoDnAT9gfVLtQS+NKO60fdAwScoB37rXtdxT/oKe986G0BFnP4mtGzXxuYpHrMoMJLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <style>
    .texto{
      word-break: break-all !important;
      white-space: nowrap !important;
    }
    .extraDelgado{ width : 40px !important; }
    .delgado{ width : 70px !important; }
    .normal{ width : 110px !important; }
    .medio{ width : 130px !important; }
  </style>
@endsection
@section('contenido')
<div class="card card-info card-tabs">
  <div class="card-header p-0 pt-1">
    <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="tabla-tab" data-toggle="pill" href="#tabla" role="tab" aria-controls="tabla" aria-selected="true">Tabla</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="grafica-tab" data-toggle="pill" href="#grafica" role="tab" aria-controls="grafica" aria-selected="false">Grafica</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="custom-tabs-five-tabContent">
      <div class="tab-pane fade show active" id="tabla" role="tabpanel" aria-labelledby="tabla-tab">
        <div class="overlay-wrapper" >
          <div class="overlay dark">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
            <div class="text-bold pt-2">Cargando...</div>
          </div>
          @include('admin.reporte.includes.tabla')
        </div>
      </div>
      <div class="tab-pane fade" id="grafica" role="tabpanel" aria-labelledby="grafica-tab">
        <div class="overlay-wrapper" >
          <div class="overlay dark" >
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
            <div class="text-bold pt-2">Cargando...</div>
          </div>
          <div class="row" >   
            <div id="unidad" style="width:500; height:450"></div>                   
            <div id="sector" style="width:500; height:450"></div>                   
          </div>       
        </div>
      </div>
  </div>
  <!-- /.card -->
</div>
  <input type="hidden" id="where" value="{{$datos['where']}}">

@endsection

@section('scripts')
  <script>
    const url = {
      "reportes"    : "{{ route('reporte.reportes') }}",
      "sectores"    : "{{ route('funcionario.sectores') }}",
      "localidades" : "{{ route('funcionario.localidades') }}",
    }
    var tituloTabla = "{{$datos['tituloPagina']}}";
    var where = "{{$datos['where']}}";
  </script>

  <script src="{{ asset('assets/scripts/admin/reporte/acciones.js') }}"></script>
  <script src="{{ asset('assets/scripts/admin/reporte/listeners.js') }}"></script>
@endsection
