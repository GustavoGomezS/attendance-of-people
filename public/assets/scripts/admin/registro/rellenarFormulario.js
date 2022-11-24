function Rellenar(data) {
  $('#nombreVisitante').html(data.nombreVisitante + " " + data.apellidoVisitante);
  $('#blah').attr('src', data.fotoVisitante);
  $("#visitante").val(data.id);

}