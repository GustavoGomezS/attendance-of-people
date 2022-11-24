@extends("theme.$theme.layout")
@section('titulo')
Registro
@endsection
@section('metadata')
<script src="{{asset("assets/$theme/plugins/bs-custom-file-input/bs-custom-file-input.js")}}"></script>
<meta name="csrf-token" content="{{csrf_token()}}"/> 

<script src="{{asset("assets/scripts/admin/residente/rellenarSelectSectorBusqueda.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/residente/rellenarSelectLocalidadBusqueda.js")}}"></script>
<script src="{{asset("assets/scripts/admin/registro/rellenarFormulario.js")}}"></script>  
<script src="{{asset("assets/scripts/admin/registro/rellenarSelectPuerta.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/registro/rellenarSelectAutoriza.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/registro/buscarRegistro.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/registro/listarVisitante.js")}}"></script> 
<script src="{{asset("assets/scripts/buscar.js")}}"></script> 
<script src="{{asset("assets/scripts/eliminar.js")}}"></script> 
<script src="{{asset("assets/scripts/editar.js")}}"></script> 
<script src="{{asset("assets/scripts/guardarFormulario.js")}}"></script> 
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-1">
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-12">
      <div class="card card-info card-outline">
        <div class="card-header h-25">
            @include('admin/registro/includes/formularioBusqueda')
        </div>
        <div class="card-body">
          <div  class="row">
            <div class="col-lg-3" >
              <div id="datos"></div>
              <div id="datosVisitante"></div>
            </div>
            <div class="col-lg-9" id="datosRegistro"></div>
          </div>
          <form id="formulario" autocomplete="off" enctype="multipart/form-data">
            @include('admin/registro/includes/modalFormulario')
          </form> 
          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
          <button type="button" class="btn btn-info" id="opcionCrear" data-toggle="modal" data-target="#modal-lg">
            Ingreso
          </button>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
  @include('admin/includes/modalConfirmDelet')
<script>  
  var token = $("#token").val();
  var tipo;
  const urlFormulario = "{{route('registro.guardar')}}";
  const urlListar = "{{route('registro.listarResidente')}}";
  const urlListarRegistro = "{{route('registro.listarRegistro')}}";
  const urlListarVisitante = "{{route('registro.listarVisitante')}}";
  const urlRellenarSelectSectorBusqueda = "{{route('residente.sectorBusqueda')}}";
  const urlRellenarSelectLocalidadBusqueda = "{{route('residente.localidadBusqueda')}}";
  const urlRellenarSelectPuerta = "{{route('registro.puerta')}}";
  const urlRellenarSelectAutoriza = "{{route('registro.autoriza')}}";
  const urlbuscarVisitante = "{{route('registro.visitante')}}";

 
  $(document).ready(function () {
    bsCustomFileInput.init()
    rellenarSelectSectorBusqueda(urlRellenarSelectSectorBusqueda);
    rellenarSelectPuerta(urlRellenarSelectPuerta);
  });

  function AccionSucces() {
    toastr.success( 'Accion Realizada Correctamente', 'Exito',{
      "positionClass": "toast-top-right"});
    document.getElementById("formulario").reset();
    $(".close").each(function () {
      $(this).trigger('click');
    }); 
    $("#buscar").trigger('click');

  }
  function AccionError(messages) {
    $.each(messages, function(index, val) {
      toastr.error( val, 'Problema al Ejecutar la Acción',{
        "positionClass": "toast-top-right"})   
    });
  }

  /* registro del formulario */
  $('#formulario').on('submit', function(e){
    e.preventDefault();
    data = $("#formulario").serialize();
    tipo = "post";
    EnvioFormulario(data,urlFormulario,token,tipo);                               
  });

  /* buscar localidad */
  $('.sectorBusqueda').on('change',function(){
    var color = $(":selected").css('background-color');
    $('.sectorBusqueda').css('background-color', color);
    var id = $(this).val();
    var datos = {sector : id}                                
    rellenarSelectLocalidadBusqueda(urlRellenarSelectLocalidadBusqueda,datos);
  });
    /* buscar info de la localidad */   
  $(document).on("click","#buscar",function(e){
    e.preventDefault();   
    var infoLocalidad = $("#formularioBusqueda").serialize();
    buscar(urlListar,infoLocalidad);
    buscarRegistro(urlListarRegistro,infoLocalidad);
    listarVisitante(urlListarVisitante,infoLocalidad);
    rellenarSelectAutoriza(urlRellenarSelectAutoriza,infoLocalidad);
    $("#idLocalidad").val($("#localidadBusqueda").val());                                 
  });
    /* buscar visitante */   
  $(document).on("click","#btnVisitante",function(e){
    e.preventDefault();   
    var documentoVisitante ={documento :  $("#docVisitante").val()};
    Editar(urlbuscarVisitante,documentoVisitante);                                 
  });
  /* paginacion */
  $(document).on("click",".pagination li a",function(e){
    e.preventDefault();   
    var url = $(this).attr("href");                                      
    buscar(url);
  });


</script>
@endsection
