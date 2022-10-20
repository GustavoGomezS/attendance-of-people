function Rellenar(data) {
  $('#documentoResidente').val(data.documentoResidente);
  $('#nombreResidente').val(data.nombreResidente);
  $('#apellidoResidente').val(data.apellidoResidente);
  $('#telefonoResidente').val(data.telefonoResidente);
  $('#sexoResidente').val(data.sexoResidente);
  $('#fechaNacimientoResidente').val(data.fechaNacimientoResidente);
  $('#blah').attr('src', data.fotoResidente);
  $("#formulario :input").prop("disabled", true);
  $("#formulario :button").removeAttr('disabled');
}