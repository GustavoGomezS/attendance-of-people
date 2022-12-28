const sectores =      new GetAsyncFunction(url.sectores,    null, rellenarSelectSectores);
const localidades =   new GetAsyncFunction(url.localidades, null, rellenarSelectLocalidades);
const residente =     new GetAsyncFunction(null, null, rellenarFormulario);
const nuevoResidente =new PostAsyncFunction(url.guardar,     null, acionSuccess, accionError);
const nuevaInformacionResidente =new PostAsyncFunction(null, null, acionSuccess, accionError);
const filtroDeBusqueda=new GetAsyncFunction(url.residentes, null, listarResidentes);
const residenteInactivo=new DeleteAsyncFunction(null, null, acionSuccess,accionError);

var urlEliminar,tipo;
$(document).ready(function () {
  resaltarLinkEnAside();
  bsCustomFileInput.init()
  sectores.ObtenerDatosDe();
});
function resaltarLinkEnAside() {
  $("#personasLi").addClass("menu-open");;
  $("#personasA").addClass("active");
  $("#residentes").addClass("active");
}

$(document).on("click","#opcionCrear",function(e){
  tipo="POST"
  document.getElementById("formulario").reset(); 
});

$(document).on("click",".actualizar",function(e){
  e.preventDefault();   
  cambioValoresParaActualizar($(this));
  residente.ObtenerDatosDe();                                  
});
function cambioValoresParaActualizar(esteResidente) {
  tipo="PUT"
  residente.datos = esteResidente.attr("id");
  residente.url = esteResidente.attr("href"); 
  nuevaInformacionResidente.url = esteResidente.attr("value");
}

/* registro del formulario */
$('#formulario').on('submit', function(e){
  e.preventDefault();
  let data;
  if (tipo=="POST") {
    nuevoResidente.datos = formDataConFile();
    nuevoResidente.Guardar();  
  } else {
    data = formDataConFile();
    data.append("_method", "PUT");
    nuevaInformacionResidente.datos = data;
    nuevaInformacionResidente.Guardar();
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
  let color = objeto.find("option:selected").css('background-color');
  objeto.css('background-color', color);
}

/* buscar Residentes */   
$("#buscar").keyup(function (evento) {
  let caracteresDelFiltro = $("#buscar").val();
  if (caracteresDelFiltro.length>=7) {
    filtroDeBusqueda.datos = $("#formularioBusqueda").serialize();
    filtroDeBusqueda.ObtenerDatosDe();
  }
});

/* desactivar residentes */   
$(document).on("click",".desactivar",function(e){
  e.preventDefault();   
  residenteInactivo.url = $(this).attr("href");                                      
});
$('#confirmar').on('click', function(){
  residenteInactivo.Eliminar();
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
  let attr = $("#nombreResidente").attr("disabled");//input para verificacion
  if (typeof attr == typeof undefined || attr == "false") {
    $("#formulario :input").prop("disabled", true);
    $("#formulario :button").removeAttr('disabled');
  } else {
    $("#formulario :input").removeAttr('disabled');
  }                                    
});