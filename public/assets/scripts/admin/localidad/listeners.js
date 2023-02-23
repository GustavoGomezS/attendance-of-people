const sectores = new GetAsyncFunction(url.sectores, null, mostrarSectores, accionError);
/* const localidades = new GetAsyncFunction(url.localidades, null, mostrarLocalidades, accionError); */
const nuevaLocalidad = new PostAsyncFunction(url.guardarLocalidad, null, accionSucces, accionError);
const localidadParaEliminar = new DeleteAsyncFunction(null, null, accionSucces, accionError);

/* Buscar al cargar la pagina*/
$(document).ready(function () {
  sectores.ObtenerDatosDe();
  table = $('#tablaDatos').DataTable(
    {
      "ajax": 
      {
        "url": url.localidades,
        "type": "GET"
      },
      columns: [
          { data: 'id' },
          { data: 'nombreSector' },
          { data: 'unidad' },
          { data: 'id',
            render: function (data, type, row, meta) {
                let fila = meta.row;
                let botones = 
                "<a href='"+route('localidad.eliminar', data)+"' class='eliminar btn btn-danger' data-toggle='modal' data-target='#exampleModalCenter'><i class='fas fa-trash'></i></a>";
                return botones;
            }
          }
      ],
      scrollY: '55vh', /* porcentaje de pantalla */
      scrollCollapse: true,
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
  resaltarLinkEnAside();
});
function resaltarLinkEnAside() {
  $("#ubicacionesLi").addClass("menu-open");;
  $("#ubicacionesA").addClass("active");
  $("#localidad").addClass("active");
}

  /* registro del formulario */
$('#formulario').on('submit', function(e){
  e.preventDefault();
  nuevaLocalidad.datos = new FormData($('#formulario')[0]);
  nuevaLocalidad.Guardar();                
});

  /* Eliminar elementos de la lista */   
$(document).on("click",".eliminar",function(e){
  e.preventDefault();   
  localidadParaEliminar.url = $(this).attr("href");                                      
});
$('#confirmar').on('click', function(){
  localidadParaEliminar.Eliminar();
});

 /* Seleccionar todos los sectores */
$('#seleccionarTodos').click(function() {
  $('#sector').find("input[type=checkbox]").prop('checked', $(this).is(':checked'));
});
