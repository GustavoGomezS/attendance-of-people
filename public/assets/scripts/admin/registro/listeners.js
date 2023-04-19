const sectores =      new GetAsyncFunction(url.sectores,    null, rellenarSelectSectores);
const localidades =   new GetAsyncFunction(url.localidades, null, rellenarSelectLocalidades);
const puertas =       new GetAsyncFunction(url.puertas,     null, rellenarSelectPuerta);
const funcionarios =    new GetAsyncFunction(url.funcionarios,  null, listarFuncionarios);
const registros =     new GetAsyncFunction(url.registros,   null, listarRegistros);
const paginacion =    new GetAsyncFunction(null,            null, listarRegistros);
const visitantes =    new GetAsyncFunction(url.visitantes,  null, listarVisitantes);
const quienAutoriza = new GetAsyncFunction(url.autoriza,    null, rellenarSelectQuienAutoriza);
const quienIngresa =  new GetAsyncFunction(url.ingresa,     null, datosQuienIngresa);
const formulario =    new PostAsyncFunction(url.guardar,     null, accionSucces, accionError);

$(document).ready(function() {
  sectores.ObtenerDatosDe();
  puertas.ObtenerDatosDe();
  resaltarLinkEnHeader();
});

function resaltarLinkEnHeader() {
  $("#navItemIngresosLink").html( "<strong>Ingresos</strong>");
  $("#navItemIngresos").addClass("active");
}

$('#formulario').on('submit', function(e) {
  e.preventDefault();
  formulario.datos = new FormData($('#formulario')[0]);
  formulario.Guardar();
});

/* buscar localidad */
$('.sectorBusqueda').on('change', function() {
  cambiarColorAlSelect($(this))
  localidades.datos = { sector: $(this).val() };
  localidades.ObtenerDatosDe();
  });
  function cambiarColorAlSelect(objeto) {
    let colorBackGround = objeto.find("option:selected").css('background-color');
    let colorTexto = objeto.find("option:selected").css('color');
    objeto.css('background-color', colorBackGround);
    objeto.css('color', colorTexto);
  }

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
  funcionarios.datos = infoLocalidad,
  registros.datos = infoLocalidad,
  visitantes.datos = infoLocalidad,
  quienAutoriza.datos = infoLocalidad;
}
function ejecutarBusquedas() {
  funcionarios.ObtenerDatosDe();
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