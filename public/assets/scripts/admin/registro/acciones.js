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

const listarFuncionarios = function (data) {
  $('#datos').empty().html(data); 
}
const listarRegistros = function (data) {
  $('#datosRegistro').empty().html(data); 
}

const listarVisitantes = function (data) {
  $('#datosVisitante').empty().html(data);  
}

const rellenarSelectQuienAutoriza = function (data) {
  $('#autorizaFuncionario').html('');
  $("#autorizaFuncionario").prepend("<option value='' seleted>Funcionario</option>");  
  $.each(data, function (indexInArray, valueOfElement) { 
    $("#autorizaFuncionario").append("<option value="+valueOfElement.id+">"+valueOfElement.nombreFuncionario+" "+valueOfElement.apellidoFuncionario+"</option>"); 
  });    
}

const datosQuienIngresa = function (data) {
  if (data.success==true) {
    Rellenar(data.data);
  }else{
    if (data.success==false) {
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
  $("#buscar").trigger('click');
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
