@extends("theme.$theme.layout")
@section('titulo')
Residentes
@endsection
@section('metadata')
<script src="{{asset("assets/$theme/plugins/bs-custom-file-input/bs-custom-file-input.js")}}"></script>
<meta name="csrf-token" content="{{csrf_token()}}"/> 
<script src="{{asset("assets/scripts/admin/residente/rellenarFormulario.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/residente/guardarResidente.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/residente/validarArchivo.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/residente/mostrarFoto.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/residente/rellenarSelectSectorBusqueda.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/residente/rellenarSelectLocalidadBusqueda.js")}}"></script> 
<script src="{{asset("assets/scripts/buscar.js")}}"></script> 
<script src="{{asset("assets/scripts/eliminar.js")}}"></script> 
<script src="{{asset("assets/scripts/editar.js")}}"></script> 
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-1">
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-12">
      <div class="card card-info card-outline">
        <div class="card-header h-25">
            @include('admin/residente/includes/formularioBusqueda')
        </div>
        <div class="card-body">
          <div id="datos"></div>
          <form id="formulario" autocomplete="off" enctype="multipart/form-data">
            @include('admin/residente/includes/modalFormulario')
          </form> 
          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
          <button type="button" class="btn btn-info" id="opcionCrear" data-toggle="modal" data-target="#modal-lg">
            Nuevo Residente
          </button>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
  @include('admin/includes/modalConfirmDelet')
<script>  
  var token = $("#token").val();
  var urlEliminar,urlEditar,urlFormulario,tipo;
  const urlListar = "{{route('residente.listar')}}";
  const urlRellenarSelectSectorBusqueda = "{{route('residente.sectorBusqueda')}}";
  const urlRellenarSelectLocalidadBusqueda = "{{route('residente.localidadBusqueda')}}";
  $(document).ready(function () {
    bsCustomFileInput.init()
    rellenarSelectSectorBusqueda(urlRellenarSelectSectorBusqueda);
  });

  function AccionSucces() {
    toastr.success( 'Accion Realizada Correctamente', 'Exito',{
      "positionClass": "toast-top-right"});
    document.getElementById("formulario").reset();
    $(".close").trigger('click'); 
  }
  function AccionError(messages) {
    $.each(messages, function(index, val) {
      toastr.error( val, 'Problema al Ejecutar la Acción',{
        "positionClass": "toast-top-right"})   
    });
    $(".close").trigger('click');  
  }

  /* Cambiar urlFormulario a guardar*/   
  $(document).on("click","#opcionCrear",function(e){
    urlFormulario="{{route('residente.guardar')}}";
    tipo="POST"
    document.getElementById("formulario").reset(); 
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
  /* registro del formulario */
  $('#formulario').on('submit', function(e){
    e.preventDefault();
    var formulario = $('#formulario')[0];
    var data;
    if (tipo=="POST") {
      data = new FormData(formulario);
      data.append("file", foto.files[0]);
      EnvioFormulario(data,urlFormulario,token,tipo);  
    } else {
      data = new FormData(formulario);
      data.append("file", foto.files[0]);
      data.append("_method", "PUT");
      EnvioFormulario(data,urlFormulario,token,tipo);
    }                              
  });

  /* buscar localidad */
  $('.sectorBusqueda').on('change',function(){
    var id = $(this).val();
    var datos = {sector : id}                                
    rellenarSelectLocalidadBusqueda(urlRellenarSelectLocalidadBusqueda,datos);
  });
    /* buscar Residentes */   
  $(document).on("click","#buscar",function(e){
    e.preventDefault();   
    var infoLocalidad = $("#formularioBusqueda").serialize();
    buscar(urlListar,infoLocalidad);                                      
  });
  /* paginacion */
  $(document).on("click",".pagination li a",function(e){
    e.preventDefault();   
    var url = $(this).attr("href");                                      
    buscar(url);
  });
  /* Eliminar elementos de la lista */   
  $(document).on("click",".eliminar",function(e){
    e.preventDefault();   
    urlEliminar = $(this).attr("href");                                      
  });
  $('#confirmar').on('click', function(){
    eliminar(urlEliminar,token);
  });
  //file type validation
  $("#foto").change(function() {
      ValidarArchivo(this.files[0]);
      //mostrar foto
      //Cuando el input cambie (se cargue un nuevo archivo) se va a ejecutar de nuevo el cambio de imagen y se verá reflejado.
      readURL(this);
  });

      /* Activar - Desactivar */   
  $(document).on("click","#actDes",function(e){
    e.preventDefault();
    var attr = $("#nombreResidente").attr("disabled");
    if (typeof attr == typeof undefined || attr == "false") {
        $("#formulario :input").prop("disabled", true);
        $("#formulario :button").removeAttr('disabled');
    } else {
      $("#formulario :input").removeAttr('disabled');
    }   
    
                                    
  });

</script>
@endsection
