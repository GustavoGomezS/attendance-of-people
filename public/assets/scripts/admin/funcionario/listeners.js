const sectores =      new GetAsyncFunction(url.sectores,    null, rellenarSelectSectores);
const localidades =   new GetAsyncFunction(url.localidades, null, rellenarSelectLocalidades);
const funcionario =     new GetAsyncFunction(null, null, rellenarFormulario);
const nuevoFuncionario =new PostAsyncFunction(url.guardar,     null, acionSuccess, accionError);
const nuevaInformacionFuncionario =new PostAsyncFunction(null, null, acionSuccess, accionError);
const filtroDeBusqueda=new GetAsyncFunction(url.funcionario, null, listarFuncionarios);
const funcionarioInactivo=new DeleteAsyncFunction(null, null, acionSuccess,accionError);

var urlEliminar,tipo;
$(document).ready(function () {
  bsCustomFileInput.init()
  sectores.ObtenerDatosDe();
  resaltarLinkEnAside();
});
function resaltarLinkEnAside() {
  $("#personasLi").addClass("menu-open");;
  $("#personasA").addClass("active");
  $("#funcionarios").addClass("active");
}

$(document).on("click","#opcionCrear",function(e){
  tipo="POST"
  document.getElementById("formulario").reset(); 
});

$(document).on("click",".actualizar",function(e){
  e.preventDefault();   
  cambioValoresParaActualizar($(this));
  funcionario.ObtenerDatosDe();                                  
});
function cambioValoresParaActualizar(esteFuncionario) {
  tipo="PUT"
  funcionario.datos = esteFuncionario.attr("id");
  funcionario.url = esteFuncionario.attr("href"); 
  nuevaInformacionFuncionario.url = esteFuncionario.attr("value");
}

/* registro del formulario */
$('#formulario').on('submit', function(e){
  e.preventDefault();
  let data;
  if (tipo=="POST") {
    nuevoFuncionario.datos = formDataConFile();
    nuevoFuncionario.Guardar();  
  } else {
    data = formDataConFile();
    data.append("_method", "PUT");
    nuevaInformacionFuncionario.datos = data;
    nuevaInformacionFuncionario.Guardar();
  }                              
});
function formDataConFile() {
  var data = new FormData($('#formulario')[0]);
  data.append("file", foto.files[0]);
  return data;
}

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

/* buscar Funcionarios */   
$("#buscar").keyup(function (evento) {
  let caracteresDelFiltro = $("#buscar").val();
  if (caracteresDelFiltro.length>=7) {
    filtroDeBusqueda.datos = $("#formularioBusqueda").serialize();
    filtroDeBusqueda.ObtenerDatosDe();
  }
});

/* desactivar Funcionario */   
$(document).on("click",".desactivar",function(e){
  e.preventDefault();   
  funcionarioInactivo.url = $(this).attr("href");                                      
});
$('#confirmar').on('click', function(){
  funcionarioInactivo.Eliminar();
});

/* paginacion */
$(document).on("click",".pagination li a",function(e){
  e.preventDefault();   
  filtroDeBusqueda.url = $(this).attr("href");  
  filtroDeBusqueda.ObtenerDatosDe();                                    
});
//file type validation
$("#foto").change(function() {
    ValidarArchivo(this.files[0]);
    readURL(this);
});

/* Activar - Desactivar */   
$(document).on("click","#actDes",function(e){
  e.preventDefault();
  let attr = $("#nombreFuncionario").attr("disabled");//input para verificacion
  if (typeof attr == typeof undefined || attr == "false") {
    $("#formulario :input").prop("disabled", true);
    $("#formulario :button").removeAttr('disabled');
  } else {
    $("#formulario :input").removeAttr('disabled');
  }                                    
});