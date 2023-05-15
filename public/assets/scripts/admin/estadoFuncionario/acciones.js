const mostrarFuncionariosDeEstaLocalidad = (data)=>{
  $('#datos').empty().html(data); 
}

const respuesta = function (data) {
  if (data.success==true) {
    limpiarFormulario();
    toastr.success('Accion Realizada Correctamente', 'Exito', {
      "positionClass": "toast-top-right"
    });
  }else{
    if (data.success==false) {
      limpiarFormulario();
      toastr.error( data.messages, 'Problema al Ejecutar la Acción',{
      "positionClass": "toast-top-right"}) 
    }
  }
}

function limpiarFormulario() {
  document.getElementById("formularioBusqueda").reset();
}