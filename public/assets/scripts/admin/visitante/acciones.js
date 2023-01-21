const rellenarFormulario = (info) => {
  let data = info.data;
  $('#documentoVisitante').val(data.documentoVisitante);
  $('#nombreVisitante').val(data.nombreVisitante);
  $('#apellidoVisitante').val(data.apellidoVisitante);
  $('#telefonoVisitante').val(data.telefonoVisitante);
  $('#estadoVisitante').val(data.estadoVisitante);
  $('#sexoVisitante').val(data.sexoVisitante);
  $('#fechaNacimientoVisitante').val(data.fechaNacimientoVisitante);
  $('#comentarioVisitante').val(data.comentarioVisitante);
  $('#blah').attr('src', data.fotoVisitante);
  $("#formulario :input").prop("disabled", true);
  $("#formulario :button").removeAttr('disabled');
}

const listarVisitantes = function (data) {
  $('#datos').empty().html(data); 
}

const acionSuccess = () => {  
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
  filtroDeBusqueda.ObtenerDatosDe();
}
function cerrarModals() {
  $(".close").each(function () {
    $(this).trigger('click');
  });  
}

const accionError = (messages) => {
  try {
    this.alertarMensajesDeError(messages);
  }
  catch(e) {
    messages = {fallo : "error al procesar la solicitud"}
    this.alertarMensajesDeError(messages);
  }
}
function alertarMensajesDeError(messages){
  $.each(messages, function(index, val) {
    toastr.error(val, 'Problema al Ejecutar la Acción', {
      "positionClass": "toast-top-right"
    })
  });
}