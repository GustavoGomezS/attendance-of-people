@extends("theme.$theme.layout")
@section('titulo')
Edificios y Puertas
@endsection
@section('metadata')
<meta name="csrf-token" content="{{csrf_token()}}"/> 
<script src="{{asset("assets/scripts/admin/sectorPuerta/buscarSector.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/sectorPuerta/buscarPuerta.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/sectorPuerta/rellenarFormulario.js")}}"></script> 
<script src="{{asset("assets/scripts/guardarFormulario.js")}}"></script> 
<script src="{{asset("assets/scripts/eliminar.js")}}"></script> 
<script src="{{asset("assets/scripts/editar.js")}}"></script> 
<script src="{{asset("assets/scripts/buscar.js")}}"></script> 
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-0">
          @include('admin/ubicacion/sectorPuerta/includes/formularioSector')
        </div>
        <div class="card-body table-responsive p-0">
          <div id="datosSector"></div>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-0">
          @include('admin/ubicacion/sectorPuerta/includes/formularioPuerta')
        </div>
        <div class="card-body table-responsive p-0">
          <div id="datosPuerta"></div>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
  </div>
  @include('admin/includes/modalConfirmDelet')
  <form id="formularioSectorUpdate" method="post" autocomplete="off" class="form-inline">
  @include('admin/ubicacion/sectorPuerta/includes/modalFormulario')
  </form>
<script>
  const urlGuardarSector = "{{route('sector.guardar')}}";
  const urlGuardarPuerta = "{{route('puerta.guardar')}}";
  var urlFormulario,data,tipo,datos={a:"a"};
  const urlBuscarSector =  "{{route('sector.listar')}}";
  const urlBuscarPuerta = "{{route('puerta.listar')}}";
  var token = $("#token").val();
  function AccionSucces() {
    toastr.success( 'Accion Realizada Correctamente', 'Exito',{
      "positionClass": "toast-top-right"});
    buscarSector(urlBuscarSector, datos);
    buscarPuerta(urlBuscarPuerta, datos);
    document.getElementById("formularioPuerta").reset();
    document.getElementById("formularioSector").reset();
    $(".close").each(function () {
      $(this).trigger('click');
    });  
  }
  function AccionError(messages) {
    $.each(messages, function(index, val) {
      toastr.error( val, 'Problema al Ejecutar la Acción',{
        "positionClass": "toast-top-right"})   
    });
      
  }
  /* Buscar */
  $(document).ready(function () {
    $("#ubicacionesLi").addClass("menu-open");;
    $("#ubicacionesA").addClass("active");
    $("#entradasEdificios").addClass("active");
   buscarSector(urlBuscarSector, datos);
   buscarPuerta(urlBuscarPuerta, datos);
  });

    /* registro del formulario */
  $('#formularioSector').on('submit', function(e){
    e.preventDefault();
    data = $("#formularioSector").serialize();
    tipo = "post";
    EnvioFormulario(data,urlGuardarSector,token,tipo);                    
  });
 /*  actualizar sector */
  $('#formularioSectorUpdate').on('submit', function(e){
    e.preventDefault();
    data = $("#formularioSectorUpdate").serialize();
    tipo = "put";
    EnvioFormulario(data,urlFormulario,token,tipo);                    
  });
  $('#formularioPuerta').on('submit', function(e){
    e.preventDefault();
    data = $("#formularioPuerta").serialize();
    tipo = "post";
    EnvioFormulario(data,urlGuardarPuerta,token,tipo);                          
  });
    /* Eliminar elementos de la lista */   
  $(document).on("click",".eliminar",function(e){
    e.preventDefault();   
    urlEliminar = $(this).attr("href");                                      
  });
  $('#confirmar').on('click', function(){
    eliminar(urlEliminar);
  });
   /* paginacion */
  $(document).on("click",".pagination li a",function(e){
    e.preventDefault();   
    var url = $(this).attr("href");                                      
    buscarSector(url);
  });

    /* Rellenar datos para editar y cambio urlformulario a actualizar*/   
  $(document).on("click",".actualizar",function(e){
    e.preventDefault();         
    /* tomo el valores impresos en el link */
    tipo="PUT"
    var id = $(this).attr("id");
    urlEditar=$(this).attr("href");
    urlFormulario=$(this).attr("value");
    Editar(urlEditar,id);                                      
  });
</script>
@endsection