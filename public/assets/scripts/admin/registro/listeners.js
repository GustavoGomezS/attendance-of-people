const sectores =      new AsyncFunction(url.sectores,    null, rellenarSelectSectores);
const localidades =   new AsyncFunction(url.localidades, null, rellenarSelectLocalidades);
const puertas =       new AsyncFunction(url.puertas,     null, rellenarSelectPuerta);
const residentes =    new AsyncFunction(url.residentes,  null, listarResidentes);
const registros =     new AsyncFunction(url.registros,   null, listarRegistros);
const paginacion =    new AsyncFunction(null,            null, listarRegistros);
const visitantes =    new AsyncFunction(url.visitantes,  null, listarVisitantes);
const quienAutoriza = new AsyncFunction(url.autoriza,    null, rellenarSelectQuienAutoriza);
const quienIngresa =  new AsyncFunction(url.ingresa,     null, datosQuienIngresa);
const formulario =    new AsyncFunction(url.guardar,     null, despuesDeGuardar, accionError);



$(document).ready(function() {
  bsCustomFileInput.init()
  sectores.ObtenerDatosDe();
  puertas.ObtenerDatosDe();
});


$('#formulario').on('submit', function(e) {
  e.preventDefault();
  formulario.Datos = $("#formulario").serialize();
  formulario.Guardar();
  /* EnviarFormulario(data, url.guardar, ); */
});


$('.sectorBusqueda').on('change', function() {
  $('.sectorBusqueda').css('background-color', $(":selected").css('background-color'));
  localidades.Datos = {
    sector: $(this).val()
  };
  localidades.ObtenerDatosDe();
});


$(document).on("click", "#buscar", function(e) {
  e.preventDefault();
  buscarInfoLocalidad();
});
function buscarInfoLocalidad() {
  asignarValores();
  ejecutarBusquedas();
  $("#idLocalidad").val($("#localidadBusqueda").val());
}
function asignarValores() {
  let infoLocalidad = $("#formularioBusqueda").serialize();
  residentes.Datos = infoLocalidad,
  registros.Datos = infoLocalidad,
  visitantes.Datos = infoLocalidad,
  quienAutoriza.Datos = infoLocalidad;
}
function ejecutarBusquedas() {
  residentes.ObtenerDatosDe();
  registros.ObtenerDatosDe();
  visitantes.ObtenerDatosDe();
  quienAutoriza.ObtenerDatosDe();
}


$(document).on("click", "#btnVisitante", function(e) {
  e.preventDefault();
  quienIngresa.Datos = {
    documento: $("#docVisitante").val()
  };
  quienIngresa.ObtenerDatosDe();
});


$(document).on("click", ".pagination li a", function(e) {
  paginacion.Datos = $("#formularioBusqueda").serialize();
  e.preventDefault();
  paginacion.Url = $(this).attr("href");
  paginacion.ObtenerDatosDe();
});
