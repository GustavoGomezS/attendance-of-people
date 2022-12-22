const mostrarPuertas = (data) => {
  $('#datosPuerta').empty().html(data); 
}

const rellenarFormularioSectorUpdate = (data) => {
  $('#nombreUpdate').val(data.nombreSector);
  $('#colorUpdate').val(data.color);
}

const mostrarSectores = (data) => {
  $('#datosSector').empty().html(data); 
}

const accionSucces = () => {  
  mostrarMensaje();
  resetearFormularios();
  refrescarDatos();
  cerrarModals();
}
function mostrarMensaje() {
  toastr.success( 'Accion Realizada Correctamente', 'Exito',
  {"positionClass": "toast-top-right"});
}

function resetearFormularios() {
  document.getElementById("formularioPuerta").reset();
  document.getElementById("formularioSector").reset();
}
function refrescarDatos() {
  sectores.ObtenerDatosDe();
  puertas.ObtenerDatosDe();
}
function cerrarModals() {
  $(".close").each(function () {
    $(this).trigger('click');
  });  
}

const accionError = (messages) => {
  $.each(messages, function(index, val) {
    toastr.error( val, 'Problema al Ejecutar la Acción',{
      "positionClass": "toast-top-right"})   
  });     
}