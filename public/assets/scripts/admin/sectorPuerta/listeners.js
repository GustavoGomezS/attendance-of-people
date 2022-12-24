const puertas = new GetAsyncFunction(url.puertas, null, mostrarPuertas, accionError);
const sectores = new GetAsyncFunction(url.sectores, null, mostrarSectores, accionError);
const nuevaPuerta = new PostAsyncFunction(url.guardarPuerta, null, accionSucces, accionError);
const nuevoSector = new PostAsyncFunction(url.guardarSector, null, accionSucces, accionError);
const elementoDeLista = new DeleteAsyncFunction(null, null, accionSucces, accionError);
const sectorParaActualizar = new GetAsyncFunction(null, null, rellenarFormularioSectorUpdate, accionError);
const sectorAntiguo = new PutAsyncFunction(null, null, accionSucces, accionError);


/* Buscar */
$(document).ready(function () {
  $("#ubicacionesLi").addClass("menu-open");;
  $("#ubicacionesA").addClass("active");
  $("#entradasEdificios").addClass("active");
  sectores.ObtenerDatosDe();
  puertas.ObtenerDatosDe();
});

  /* registro del formulario */
$('#formularioSector').on('submit', function(e){
  e.preventDefault();
  nuevoSector.datos = new FormData($('#formularioSector')[0]);
  nuevoSector.Guardar();            
});

$('#formularioPuerta').on('submit', function(e){
  e.preventDefault();
  nuevaPuerta.datos =  new FormData($('#formularioPuerta')[0]);
  nuevaPuerta.Guardar();                        
});

  /* Eliminar elementos de la lista */   
$(document).on("click",".eliminar",function(e){
  e.preventDefault();   
  elementoDeLista.url = $(this).attr("href");                                      
});
$('#confirmar').on('click', function(){
  elementoDeLista.Eliminar();
});

  /* Rellenar datos para editar sector*/   
$(document).on("click",".actualizar",function(e){
  e.preventDefault();         
  sectorParaActualizar.url = $(this).attr("href");
  sectorParaActualizar.ObtenerDatosDe();  
  sectorAntiguo.url = $(this).attr("value");                                 
});

/*  actualizar sector */
$('#formularioSectorUpdate').on('submit', function(e){
  e.preventDefault();
  sectorAntiguo.datos = $("#formularioSectorUpdate").serialize();
  sectorAntiguo.Actualizar();               
});

  /* paginacion */
$(document).on("click",".pagination li a",function(e){
  e.preventDefault();   
  sectores.url = $(this).attr("href");
  sectores.ObtenerDatosDe();                                     
});