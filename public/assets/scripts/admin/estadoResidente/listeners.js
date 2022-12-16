const localidad = new AsyncFunction(null, null, mostrarResidentesDeEstaLocalidad);
const nuevoEstadoDelResidente = new AsyncFunction(url.update, null, alertarSucces);
/* buscar residentes de la localidad */   
$(document).on("click",".buscar",function(e){
  e.preventDefault();
  localidad.Url = $(this).attr("href");
  localidad.ObtenerDatosDe();                   
});
/* cambiar estado de residente */   
$(document).on("change",".estadoResidente",function(e){
  nuevoEstadoDelResidente.Datos = $(this).closest('.formulario').serialize();
  nuevoEstadoDelResidente.ObtenerDatosDe();
});