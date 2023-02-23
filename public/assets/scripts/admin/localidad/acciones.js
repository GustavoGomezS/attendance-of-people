const mostrarSectores = (data) => {
  $('#sector').html('');
  $.each(data, function (indexInArray, val) { 
    $("#sector").append(
      "<div class='form-check float-left ml-1'>"
        +"<input class='form-check-input ' type='checkbox' name='sector[]' id="+val.id+" value="+val.id+">"
        +"<label class='form-check-label' for="+val.id+">"+val.nombreSector+"</label>"
      +"</div>"
    );   
  });  
} 

const mostrarLocalidades = (data) => {
  $('#datos').empty().html(data); 
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
  document.getElementById("formulario").reset();
}
function refrescarDatos() {
  table.ajax.reload();
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