const localidad = new GetAsyncFunction(null, null, mostrarFuncionariosDeEstaLocalidad);
const nuevoEstadoDelFuncionario = new GetAsyncFunction(url.update, null, respuesta);
const filtroDeBusqueda= new GetAsyncFunction(url.updateManual, null, respuesta, );

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

/* buscar Funcionarios */   
let $comment = document.getElementById("buscar")
let timeout
//El evento lo puedes reemplazar con keyup, keypress y el tiempo a tu necesidad
$comment.addEventListener('keydown', () => {
  clearTimeout(timeout)
  timeout = setTimeout(() => {
    filtroDeBusqueda.datos = $("#formularioBusqueda").serialize();
    filtroDeBusqueda.ObtenerDatosDe();
    clearTimeout(timeout)
  },1000)
})

$(document).ready(function () {
  resaltarLinkEnHeader();
  document.getElementById('buscar').focus();
})
function resaltarLinkEnHeader() {
  $("#navItemFuncionariosLink").html( "<strong>Funcionarios</strong>");
  $("#navItemFuncionarios").addClass("active");
}