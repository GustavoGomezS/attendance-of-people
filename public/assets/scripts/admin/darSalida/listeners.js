var table;

const puertas =    new AsyncFunction(url.puertas,     null, rellenarSelectPuerta);
const formulario = new AsyncFunction(url.darSalida,   null, accionSucces, accionError);

$(document).ready(function () {
  puertas.ObtenerDatosDe();
  table = $('#tablaDatos').DataTable(
  {
    "ajax": 
    {
      "url": url.visitantes,
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
    var data = prepararData();
    formulario.Datos = data;
    formulario.Guardar();                 
  });
  function prepararData() {
    var data = { 
      id : [], 
      puerta : $("#puerta").val(), 
      comentario : $("#comentario").val(),
      ingresoSalida : $("#ingresoSalida").val()
    }
    agregarIdResidentesAlData(data);
    return data;
  }
  function agregarIdResidentesAlData(data) {
    for (let index = 0; index < table.rows('.selected').data().length; index++) {
      data.id.push(table.rows('.selected').data()[index].DT_RowId);
    }
  }
});