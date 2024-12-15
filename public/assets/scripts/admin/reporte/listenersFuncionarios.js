const sectores    = new GetAsyncFunction(url.sectores,    null, rellenarSelectSectores);
const localidades = new GetAsyncFunction(url.localidades, null, rellenarSelectLocalidades);
var table

$(document).ready(function () {
  if (where=="sector" || where=="localidad") {
    sectores.ObtenerDatosDe();
  }

  table = $('#tablaFuncionario').DataTable(
  {
    "ajax": 
    {
      "beforeSend": function(){
        $(".overlay").show();
      },
      "url": url.reportes,
      "type": "GET",
      "data":function(d){
        d.fechaInicio = $("#fechaInicio").val();
        d.fechaFin = $("#fechaFin").val();
        d.sector = $("#idSector").val();
        d.localidad = $("#idLocalidad").val();
        d.funcionario = $("#idFuncionario").val();
        d.where = $("#where").val();
      },
      "complete" : function (data) {
        $(".overlay").hide();
        /* var localidadesParaGrafica = Object.values(data.responseJSON.graficas.localidades);
        var sectoresParaGrafica = Object.values(data.responseJSON.graficas.sectores);
        drawChart(localidadesParaGrafica, 'unidad');
        drawChart(sectoresParaGrafica, 'sector'); */
      }
    },
    columns: [
      { data: 'nombreFuncionario' },
      { data: 'unidad' },
      { data: 'nombreEstado' },
      { data: 'RFecha' },
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
      info: 'Mostrando _START_ a _END_ de _TOTAL_ Registros',
      infoEmpty: 'No hay registros disponibles',
      infoFiltered: '(Filtrado de _MAX_ Registros totales)',
    },
    scrollY: '65vh', /* porcentaje de pantalla */
    scrollCollapse: true,
    order: [[ 3, "desc" ]],
    dom: '<"top"<"d-flex justify-content-between"B<"#tituloTabla.h4">f>>rt<"bottom"<"d-flex justify-content-between"lip>>',
    buttons: [
        {
          extend: 'print',
          text : 'Imprimir',
          /* messageTop: 'This print was produced using the Print button for DataTables' */
        },
        'excel',
        'pdf',
        {
          /* extend: 'colvis', */
          text : 'Columnas',
        }, 
  ],
    lengthMenu: [
      [20, 50, -1],
      [20, 50, 'Todas'],
    ]
  });

  //botones
  new $.fn.dataTable.Buttons( table, { buttons: ['copy', 'excel', 'pdf']});
  table.buttons().container().appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );

  $("#tituloTabla").html(tituloTabla); 
  resaltarLinkEnHeader();
});

//recargar la tabla
$(document).on("click","#buscar",function(e){
  e.preventDefault();   
  table.ajax.reload();
});

$('.sectorBusqueda').on('change', function() {
  $('.sectorBusqueda').css('background-color', $(":selected").css('background-color'));
  localidades.datos = { sector: $(this).val() };
  localidades.ObtenerDatosDe();
});

function resaltarLinkEnHeader() {
  $("#dropdownSubMenu1").html( "<strong>Reportes</strong>");
  $("#navItemReporte").addClass("active");
}
