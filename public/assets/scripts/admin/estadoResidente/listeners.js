const localidad = new GetAsyncFunction(null, null, mostrarResidentesDeEstaLocalidad);
const nuevoEstadoDelResidente = new GetAsyncFunction(url.update, null, alertarSucces);
/* buscar residentes de la localidad */   
$(document).on("click",".buscar",function(e){
  e.preventDefault();
  localidad.url = $(this).attr("href");
  localidad.ObtenerDatosDe();            
  modificarHeader($(this));       
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
$(document).ready(function () {
  resaltarLinkEnHeader();
})
function resaltarLinkEnHeader() {
  $("#navItemResidentesLink").html( "<strong>Residentes</strong>");
  $("#navItemResidentes").addClass("active");
}