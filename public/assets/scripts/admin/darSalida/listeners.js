var table;

const puertas =    new GetAsyncFunction(url.puertas,     null, rellenarSelectPuerta);
const formulario = new PostAsyncFunction(url.darSalida,   null, accionSucces, accionError);

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
      info: 'Mostrando _START_ a _END_ de _TOTAL_ Registros',
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
    formulario.datos = prepararData();
    formulario.Guardar();                 
  });
  function prepararData() {
    var formData = new FormData();
    agregarDatosDelFormulario(formData);
    agregarIdResidentes(formData);
    return formData;
  }
  function agregarDatosDelFormulario(formData) {
    formData.append('puerta', $("#puerta").val());
    formData.append('comentario', $("#comentario").val());
    formData.append('ingresoSalida', $("#ingresoSalida").val());
  }
  function agregarIdResidentes(formData) {
    for (let index = 0; index < table.rows('.selected').data().length; index++) {
      formData.append('id[]', table.rows('.selected').data()[index].DT_RowId);
    }
  }
});