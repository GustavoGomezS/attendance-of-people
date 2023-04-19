const sectores    = new GetAsyncFunction(url.sectores,    null, rellenarSelectSectores);
const localidades = new GetAsyncFunction(url.localidades, null, rellenarSelectLocalidades);
var table

$(document).ready(function () {

  if (where=="sector" || where=="localidad") {
    sectores.ObtenerDatosDe();
  }

   table = $('#tablaDatos').DataTable(
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
        d.visitante = $("#idVisitante").val();
        d.where = $("#where").val();
      },
      "complete" : function (data) {
        $(".overlay").hide();
        var localidadesParaGrafica = Object.values(data.responseJSON.graficas.localidades);
        var sectoresParaGrafica = Object.values(data.responseJSON.graficas.sectores);
        drawChart(localidadesParaGrafica, 'unidad');
        drawChart(sectoresParaGrafica, 'sector');
      }
    },
    columns: [
      {
        className: 'dt-control',
        orderable: false,
        data: null,
        defaultContent: '',
      },
      { data: 'nombreVisitante' },
      { data: 'ingresoSalida' },
      { data: 'nombreFuncionario' },
      { data: 'nombrePuerta' },
      { data: 'comentario' },
      { data: 'created_at' },
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
    scrollY: '60vh', /* porcentaje de pantalla */
    scrollCollapse: true,
    order: [[6, 'desc']],
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
          extend: 'colvis',
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

// listener de apertura y cierre de detalles
$('#tablaDatos tbody').on('click', 'td.dt-control', function () {
  var tr = $(this).closest('tr');
  var row = table.row(tr);
  if (row.child.isShown()) { // cerrar fila
    row.child.hide();
    tr.removeClass('shown');
  } else { // abrir fila  
    row.child(format(row.data())).show();
    tr.addClass('shown');
  }
});

/* Función de formato para detalles de fila:  */
function format(d) {
  // `d` es el objeto de datos original para la fila
  return (
    '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" class="table-striped stripe compact">' +
      '<tr>' +
          '<th>Nombre : </th>' +
          '<td colspan="3">' + d.nombreVisitanteCompleto + '</td>' +
      '</tr>' +

      '<tr>' +
          '<th>Documento : </th>' +
          '<td>' + d.documentoVisitante + '</td>' +
          '<th>Telefono : </th>' +
          '<td>' + d.telefonoVisitante + '</td>' +
      '</tr>' +
      
      '<tr>' +
        '<th>Fotografia :</th>' +
        '<td colspan="3">' +
          '<img src="'+d.fotoVisitante+'" alt="foto de funcionario" width="200" height="170" class="rounded border-bottom-0 border border-info">'+
        '</td>' +
      '</tr>' +
    '</table>'
  );
}

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

/* Graficas */
google.charts.load('current', {'packages':['corechart']}); //cargar api
google.charts.setOnLoadCallback(drawChart); //dibujar grafica

function drawChart(data,titulo) {
  let infoGrafica = crearArray(data);
  let options = {
    'title':'Ingresos por '+ titulo,
    pieHole: 0.4,
    legend : {"position":"none","textStyle":{"color":"#000000","fontSize":14}},
    'width':500,
    'height':450,
    "fontSize":14
  };
  let grafica = new google.visualization.PieChart(document.getElementById(titulo));
  grafica.draw(establecerDatosDe(infoGrafica), options);
}
function crearArray(infoSinFormatear) {
  let array = [["sin Datos", 1]];
  if (infoSinFormatear) {
    return array = infoSinFormatear?.map(index => [index.unidad, index.ingresos]);
  } else {
    return array;
  }
}
function establecerDatosDe(informacionGrafica) {
  let data = new google.visualization.DataTable();
  data.addColumn('string', 'Topping');
  data.addColumn('number', 'Slices');
  data.addRows(informacionGrafica);
  return data
}

function resaltarLinkEnHeader() {
  $("#dropdownSubMenu1").html( "<strong>Registros</strong>");
  $("#navItemRegistros").addClass("active");
}
