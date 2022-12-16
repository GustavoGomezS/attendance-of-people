const accionSucces = function () {
  alertarMensajeSucces();
  cerrarTodosLosModal();
  document.getElementById("formulario").reset();
  table.ajax.reload();
}
function alertarMensajeSucces() {
  toastr.success( 'Accion Realizada Correctamente',
  'Exito',{
  "positionClass": "toast-top-right"});
}
function cerrarTodosLosModal() {
  $(".close").each(function () {
    $(this).trigger('click');
  }); 
}

const accionError = function (messages) {
  toastr.error( 'La accion no se pudo realizar', 
  'Problema al Ejecutar la Acción',{
  "positionClass": "toast-top-right"});   

  $("#cerrarModal").trigger('click');  
}

const rellenarSelectPuerta = function (data) {
  $('#puerta').html('');
  $.each(data, function (indexInArray, valueOfElement) { 
    $("#puerta").append("<option value="+valueOfElement.id+">"+valueOfElement.nombrePuerta+"</option>"); 
  }); 
}
