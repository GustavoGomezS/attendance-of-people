const rellenarSelectSectores = function (data) {
  $('.sectorBusqueda').html('');
  $('.sectorBusqueda').css('color', 'white');
  $(".sectorBusqueda").prepend("<option value='' seleted>Sector</option>");  
  $.each(data, function (indexInArray, valueOfElement) { 
    $(".sectorBusqueda").append("<option value="+valueOfElement.id+" style=' background-color :"+valueOfElement.color+"'>"+valueOfElement.nombreSector+"</option>"); 
  });
}

const rellenarSelectLocalidades= function (data) {
    $('.localidadBusqueda').html('');
    $('.localidadBusqueda').css('background-color', data[0].color);
    $('.localidadBusqueda').css('color', 'white');
    $(".localidadBusqueda").prepend("<option value='' seleted >Localidad</option>");  
    $.each(data, function (indexInArray, valueOfElement) { 
      $(".localidadBusqueda").append("<option value="+valueOfElement.id+">"+valueOfElement.unidad+"</option>"); 
    }); 
}

const rellenarSelectPuerta = function (data) {
  $('#puerta').html('');
  $.each(data, function (indexInArray, valueOfElement) { 
    $("#puerta").append("<option value="+valueOfElement.id+">"+valueOfElement.nombrePuerta+"</option>"); 
  }); 
}

const listarResidentes = function (data) {
  $('#datos').empty().html(data); 
}
const listarRegistros = function (data) {
  $('#datosRegistro').empty().html(data); 
}

const listarVisitantes = function (data) {
  $('#datosVisitante').empty().html(data);  
}

const rellenarSelectQuienAutoriza = function (data) {
  $('#autorizaResidente').html('');
  $("#autorizaResidente").prepend("<option value='' seleted>Residente</option>");  
  $.each(data, function (indexInArray, valueOfElement) { 
    $("#autorizaResidente").append("<option value="+valueOfElement.id+">"+valueOfElement.nombreResidente+" "+valueOfElement.apellidoResidente+"</option>"); 
  });    
}

const datosQuienIngresa = function (data) {
  if (data.success=="true") {
    Rellenar(data.data[0]);
  }else{
    if (data.success=="false") {
      toastr.error( data.messages, 'Problema al Ejecutar la Acción',{
      "positionClass": "toast-top-right"}) 
    }
  }
}
function Rellenar(data) {
  $('#nombreVisitante').html(data.nombreVisitante + " " + data.apellidoVisitante);
  $('#blah').attr('src', data.fotoVisitante);
  $("#visitante").val(data.id);
}

const despuesDeGuardar = function AccionSucces(data) {
  toastr.success('Accion Realizada Correctamente', 'Exito', {
    "positionClass": "toast-top-right"
  });
  document.getElementById("formulario").reset();
  $(".close").each(function() {
    $(this).trigger('click');
  });
  $("#buscar").trigger('click');
}

const accionError = function  AccionError(messages) {
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
