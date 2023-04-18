const rellenarFormulario = (info) => {
  let data = info.data;
  $('#documentoResidente').val(data.documentoResidente);
  $('#nombreResidente').val(data.nombreResidente);
  $('#apellidoResidente').val(data.apellidoResidente);
  $('#telefonoResidente').val(data.telefonoResidente);
  $('#sexoResidente').val(data.sexoResidente);
  $('#poderAutorizar').val(data.poderAutorizar);
  $('#fechaNacimientoResidente').val(data.fechaNacimientoResidente);
  $('#blah').attr('src', data.fotoResidente);
  $("#formulario :input").prop("disabled", true);
  $("#formulario :button").removeAttr('disabled');
}

const rellenarSelectSectores = (data) =>{
    $('.sectorBusqueda').html('');
    $(".sectorBusqueda").prepend("<option value='0' style='background-color : #FFFFFF; color : #000000;'>Sector</option>");  
    $.each(data, function (indexInArray, valueOfElement) { 
      $(".sectorBusqueda").append("<option value="+valueOfElement.id+" style=' background-color :"+valueOfElement.color+"; color:#FFFFFF;'>"+valueOfElement.nombreSector+"</option>"); 
    });
    $("#sector").val("0");
    $("#sector").change();
}

const rellenarSelectLocalidades= function (data) {
    $('.localidadBusqueda').html('');
    $('.localidadBusqueda').css('background-color', data[0]?.color);
    $('.localidadBusqueda').css('color', 'white');
    $(".localidadBusqueda").prepend("<option value='' seleted >Localidad</option>");  
    $.each(data, function (indexInArray, valueOfElement) { 
      $(".localidadBusqueda").append("<option value="+valueOfElement.id+">"+valueOfElement.unidad+"</option>"); 
    }); 
}

const listarResidentes = function (data) {
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