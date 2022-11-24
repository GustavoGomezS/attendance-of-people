@extends("theme.$theme.layout")
@section('titulo')
Salida
@endsection
@section('metadata')
<link rel="stylesheet" type="text/css" href="{{asset("assets/DataTables/datatables.min.css")}}"/>
<script src="{{asset("assets/scripts/admin/darSalida/buscar.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/registro/rellenarSelectPuerta.js")}}"></script> 
<script src="{{asset("assets/scripts/guardarFormulario.js")}}"></script> 
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
  <script>
  var table;
  const url = "{{route('visitante.dentro.buscar')}}";
  const urlDarSalida = "{{route('visitante.darSalida')}}";
  const urlRellenarSelectPuerta = "{{route('registro.puerta')}}";
 
  function AccionSucces() {
  toastr.success( 'Accion Realizada Correctamente', 'Exito',{
    "positionClass": "toast-top-right"});
  document.getElementById("formulario").reset();
  $(".close").each(function () {
    $(this).trigger('click');
  }); 
  table.ajax.reload();
  }
  function AccionError(messages) {
    $.each(messages, function(index, val) {
      toastr.error( val, 'Problema al Ejecutar la Acción',{
        "positionClass": "toast-top-right"})   
    });
    $("#cerrarModal").trigger('click');  
  }
  $(document).ready(function () {
    rellenarSelectPuerta(urlRellenarSelectPuerta);
    table = $('#tablaDatos').DataTable(
    {
      "ajax": 
      {
        "url": url,
        "type": "GET"
      },
      columns: [
          { data: 'nombreVisitante' },
          { data: 'telefonoVisitante' },
          { data: 'documentoVisitante' },
          { data: 'sectorUnidad' },
      ],
      language: 
      {
        "loadingRecords": "Cargando...",
        "search":         "Buscar:",
        "paginate": 
        {
          "first":      "Primer",
          "last":       "Ultimo",
          "next":       "Próximo",
          "previous":   "Anterior"
        },
        lengthMenu: 'Mostrar _MENU_ Registros por página',
        zeroRecords: 'No se encontró nada - lo siento',
        info: 'Mostrando página _PAGE_ de _PAGES_',
        infoEmpty: 'No hay registros disponibles',
        infoFiltered: '(Filtrado de _MAX_ Registros totales)',
      },
    });
    /* seleccionar filas */
    $('#tablaDatos tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });
    /* accion con filas seleccionadas */
    $('#formulario').on('submit', function(e){
      e.preventDefault();
      var data = { 
        id : [], 
        puerta : $("#puerta").val(), 
        comentario : $("#comentario").val(),
        ingresoSalida : $("#ingresoSalida").val()
      }
      var token = $("#token").val();
      for (let index = 0; index < table.rows('.selected').data().length; index++) {
       data.id.push(table.rows('.selected').data()[index].DT_RowId);
      }
      tipo = "post";
      EnvioFormulario(data,urlDarSalida,token,tipo);                    
    });
  });
</script>
@endsection
