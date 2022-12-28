const visitante =     new GetAsyncFunction(null, null, rellenarFormulario);
const nuevoVisitante =new PostAsyncFunction(url.guardar,     null, acionSuccess, accionError);
const nuevaInformacionVisitante =new PostAsyncFunction(null, null, acionSuccess, accionError);
const filtroDeBusqueda=new GetAsyncFunction(url.visitantes, null, listarVisitantes);
const visitanteInactivo=new DeleteAsyncFunction(null, null, acionSuccess,accionError);

var token = $("#token").val();
var urlEliminar,urlEditar,urlFormulario,tipo;
const urlListar = "{{route('visitante.listar')}}";
$(document).ready(function () {
  bsCustomFileInput.init();
  resaltarLinkEnAside();
});
function resaltarLinkEnAside() {
  $("#personasLi").addClass("menu-open");;
  $("#personasA").addClass("active");
  $("#visitantes").addClass("active");
}

/* Cambiar urlFormulario a guardar*/   
$(document).on("click","#opcionCrear",function(e){
  tipo="POST"
  document.getElementById("formulario").reset(); 
});

/* Rellenar datos para editar y cambio urlformulario a actualizar*/   
$(document).on("click",".actualizar",function(e){
  e.preventDefault();   
  cambioValoresParaActualizar($(this));
  visitante.ObtenerDatosDe();                                          
});
function cambioValoresParaActualizar(esteVisitante) {
  tipo="PUT"
  visitante.datos = esteVisitante.attr("id");
  visitante.url = esteVisitante.attr("href"); 
  nuevaInformacionVisitante.url = esteVisitante.attr("value");
}

/* registro del formulario */
$('#formulario').on('submit', function(e){
  e.preventDefault();
  let data;
  if (tipo=="POST") {
    nuevoVisitante.datos = formDataConFile();
    nuevoVisitante.Guardar();  
  } else {
    data = formDataConFile();
    data.append("_method", "PUT");
    nuevaInformacionVisitante.datos = data;
    nuevaInformacionVisitante.Guardar();
  }                              
});
function formDataConFile() {
  var data = new FormData($('#formulario')[0]);
  data.append("file", foto.files[0]);
  return data;
}

/* buscar visitantes */  
$("#buscar").keyup(function (evento) {
  let caracteresDelFiltro = $("#buscar").val();
  if (caracteresDelFiltro.length>=7) {
    filtroDeBusqueda.datos = $("#formularioBusqueda").serialize();
    filtroDeBusqueda.ObtenerDatosDe();
  }
});

/* paginacion */
$(document).on("click",".pagination li a",function(e){
  e.preventDefault();   
  filtroDeBusqueda.url = $(this).attr("href");  
  filtroDeBusqueda.ObtenerDatosDe();        
});

/* desactivar visitantes */   
$(document).on("click",".desactivar",function(e){
  e.preventDefault();   
  visitanteInactivo.url = $(this).attr("href");                                      
});
$('#confirmar').on('click', function(){
  visitanteInactivo.Eliminar();
});

//file type validation
$("#foto").change(function() {
  ValidarArchivo(this.files[0]);
  readURL(this);
});

/* Activar - Desactivar */   
$(document).on("click","#actDes",function(e){
  e.preventDefault();
  var attr = $("#nombreVisitante").attr("disabled");
  if (typeof attr == typeof undefined || attr == "false") {
    $("#formulario :input").prop("disabled", true);
    $("#formulario :button").removeAttr('disabled');
  } else {
    $("#formulario :input").removeAttr('disabled');
  }                                   
});