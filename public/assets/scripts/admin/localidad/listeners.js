const sectores = new GetAsyncFunction(url.sectores, null, mostrarSectores, accionError);
const localidades = new GetAsyncFunction(url.localidades, null, mostrarLocalidades, accionError);
const nuevaLocalidad = new PostAsyncFunction(url.guardarLocalidad, null, accionSucces, accionError);
const localidadParaEliminar = new DeleteAsyncFunction(null, null, accionSucces, accionError);

/* Buscar al cargar la pagina*/
$(document).ready(function () {
  resaltarLinkEnAside();
  sectores.ObtenerDatosDe();
  localidades.ObtenerDatosDe();
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

  /* paginacion */
$(document).on("click",".pagination li a",function(e){
  e.preventDefault();   
  localidades.url = $(this).attr("href");                                      
  localidades.ObtenerDatosDe();
});