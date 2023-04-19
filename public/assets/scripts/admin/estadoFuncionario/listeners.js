const localidad = new GetAsyncFunction(null, null, mostrarFuncionariosDeEstaLocalidad);
const nuevoEstadoDelFuncionario = new GetAsyncFunction(url.update, null, alertarSucces);
/* buscar Funcionarios de la localidad */   
$(document).on("click",".buscar",function(e){
  e.preventDefault();
  localidad.url = $(this).attr("href");
  localidad.ObtenerDatosDe();            
  modificarHeader($(this));       
});
function modificarHeader(objeto) {
  $(".modal-header h4").text(objeto.text());
  $(".modal-header").css({'background-color': objeto.css('background-color'), 'color' : 'white'});
}

/* cambiar estado de Funcionario */   
$(document).on("change",".estadoFuncionario",function(e){
  nuevoEstadoDelFuncionario.datos = $(this).closest('.formulario').serialize();
  nuevoEstadoDelFuncionario.ObtenerDatosDe();
});
$(document).ready(function () {
  resaltarLinkEnHeader();
})
function resaltarLinkEnHeader() {
  $("#navItemFuncionariosLink").html( "<strong>Funcionarios</strong>");
  $("#navItemFuncionarios").addClass("active");
}