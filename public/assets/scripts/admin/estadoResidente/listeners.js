const localidad = new GetAsyncFunction(null, null, mostrarResidentesDeEstaLocalidad);
const nuevoEstadoDelResidente = new GetAsyncFunction(url.update, null, alertarSucces);
/* buscar residentes de la localidad */   
$(document).on("click",".buscar",function(e){
  e.preventDefault();
  modificarHeader($(this));
  localidad.url = $(this).attr("href");
  localidad.ObtenerDatosDe();                   
});
function modificarHeader(objeto) {
  $(".modal-header h4").text(objeto.text());
  $(".modal-header").css({'background-color': objeto.css('background-color'), 'color' : 'white'});
}
/* cambiar estado de residente */   
$(document).on("change",".estadoResidente",function(e){
  nuevoEstadoDelResidente.datos = $(this).closest('.formulario').serialize();
  nuevoEstadoDelResidente.ObtenerDatosDe();
});