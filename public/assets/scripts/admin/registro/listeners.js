const sectores =      new GetAsyncFunction(url.sectores,    null, rellenarSelectSectores);
const localidades =   new GetAsyncFunction(url.localidades, null, rellenarSelectLocalidades);
const puertas =       new GetAsyncFunction(url.puertas,     null, rellenarSelectPuerta);
const residentes =    new GetAsyncFunction(url.residentes,  null, listarResidentes);
const registros =     new GetAsyncFunction(url.registros,   null, listarRegistros);
const paginacion =    new GetAsyncFunction(null,            null, listarRegistros);
const visitantes =    new GetAsyncFunction(url.visitantes,  null, listarVisitantes);
const quienAutoriza = new GetAsyncFunction(url.autoriza,    null, rellenarSelectQuienAutoriza);
const quienIngresa =  new GetAsyncFunction(url.ingresa,     null, datosQuienIngresa);
const formulario =    new PostAsyncFunction(url.guardar,     null, accionSucces, accionError);

$(document).ready(function() {
  bsCustomFileInput.init()
  sectores.ObtenerDatosDe();
  puertas.ObtenerDatosDe();
});

$('#formulario').on('submit', function(e) {
  e.preventDefault();
  formulario.datos = new FormData($('#formulario')[0]);
  formulario.Guardar();
  /* EnviarFormulario(data, url.guardar, ); */
});

$('.sectorBusqueda').on('change', function() {
  $('.sectorBusqueda').css('background-color', $(":selected").css('background-color'));
  localidades.datos = {
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
  residentes.datos = infoLocalidad,
  registros.datos = infoLocalidad,
  visitantes.datos = infoLocalidad,
  quienAutoriza.datos = infoLocalidad;
}
function ejecutarBusquedas() {
  residentes.ObtenerDatosDe();
  registros.ObtenerDatosDe();
  visitantes.ObtenerDatosDe();
  quienAutoriza.ObtenerDatosDe();
}

$(document).on("click", "#btnVisitante", function(e) {
  e.preventDefault();
  quienIngresa.datos = {
    documento: $("#docVisitante").val()
  };
  quienIngresa.ObtenerDatosDe();
});

$(document).on("click", ".pagination li a", function(e) {
  paginacion.datos = $("#formularioBusqueda").serialize();
  e.preventDefault();
  paginacion.url = $(this).attr("href");
  paginacion.ObtenerDatosDe();
});