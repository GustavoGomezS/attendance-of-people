const accionSucces = () => {  
  mostrarMensaje();
  resetearFormularios();
  refrescarDatos();
}
function mostrarMensaje() {
  toastr.success( 'Accion Realizada Correctamente', 'Exito',
  {"positionClass": "toast-top-right"});
}

function resetearFormularios() {
  document.getElementById("formulario").reset();
}
function refrescarDatos() {
  table.ajax.reload();
}

const accionError = (messages) => {
  $.each(messages, function(index, val) {
    toastr.error( val, 'Problema al Ejecutar la Acción',{
      "positionClass": "toast-top-right"})   
  });     
}