const nuevaNovedad = new PostAsyncFunction(url.guardarNovedad, null, accionSucces, accionError);
let table

$(document).ready(function () {
  table = $('#tablaDatos').DataTable(
    {
      "ajax": 
      {
        "url": url.registros,
        "type": "GET",
        "data":function(d){
          d.fechaInicio = $("#fechaInicio").val();
          d.fechaFin = $("#fechaFin").val();
             },
      },
      columns: [
        { data: 'nombreUsuario' },
        { data: 'comentario' },
        { data: 'created_at' },
      ],  
      columnDefs: [
        { className: "texto normal", targets: "_all"  }
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
      scrollCollapse: true,
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
        [10, 20, 50, -1],
        [10, 20, 50, 'Todas'],
      ]
    });
  
  resaltarLinkEnHeader();
});

//recargar la tabla
$(document).on("click","#buscar",function(e){
  e.preventDefault();   
  table.ajax.reload();
});

function resaltarLinkEnHeader() {
  $("#navItemMinutaLink").html( "<strong>Minuta</strong>");
  $("#navItemMinuta").addClass("active");
}

$('#formulario').on('submit', function(e){
  e.preventDefault();
  nuevaNovedad.datos = new FormData($('#formulario')[0]);
  nuevaNovedad.Guardar();            
});