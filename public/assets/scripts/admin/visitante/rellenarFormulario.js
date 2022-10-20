function Rellenar(data) {
  $('#documentoVisitante').val(data.documentoVisitante);
  $('#nombreVisitante').val(data.nombreVisitante);
  $('#apellidoVisitante').val(data.apellidoVisitante);
  $('#telefonoVisitante').val(data.telefonoVisitante);
  $('#estadoVisitante').val(data.estadoVisitante);
  $('#sexoVisitante').val(data.sexoVisitante);
  $('#fechaNacimientoVisitante').val(data.fechaNacimientoVisitante);
  $('#blah').attr('src', data.fotoVisitante);
  $("#formulario :input").prop("disabled", true);
  $("#formulario :button").removeAttr('disabled');
}