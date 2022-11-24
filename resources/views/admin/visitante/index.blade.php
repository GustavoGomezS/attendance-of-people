@extends("theme.$theme.layout")
@section('titulo')
visitantes
@endsection
@section('metadata')
<script src="{{asset("assets/$theme/plugins/bs-custom-file-input/bs-custom-file-input.js")}}"></script>
<meta name="csrf-token" content="{{csrf_token()}}"/> 
<script src="{{asset("assets/scripts/admin/visitante/rellenarFormulario.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/visitante/guardarVisitante.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/visitante/validarArchivo.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/visitante/mostrarFoto.js")}}"></script> 
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
            @include('admin/visitante/includes/formularioBusqueda')
        </div>
        <div class="card-body">
          <div id="datos"></div>
          <form id="formulario" autocomplete="off" enctype="multipart/form-data">
            @include('admin/visitante/includes/modalFormulario')
          </form> 
          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
          <button type="button" class="btn btn-info" id="opcionCrear" data-toggle="modal" data-target="#modal-lg">
            Nuevo visitante
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
  const urlListar = "{{route('visitante.listar')}}";
  $(document).ready(function () {
    bsCustomFileInput.init()
    $("#personasLi").addClass("menu-open");;
    $("#personasA").addClass("active");
    $("#visitantes").addClass("active");
  });

  function AccionSucces() {
    toastr.success( 'Accion Realizada Correctamente', 'Exito',{
      "positionClass": "toast-top-right"});
    document.getElementById("formulario").reset();
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

  /* Cambiar urlFormulario a guardar*/   
  $(document).on("click","#opcionCrear",function(e){
    urlFormulario="{{route('visitante.guardar')}}";
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

  /* buscar visitantes */  
    /* buscar */
  $("#buscar").keyup(function (evento) {
    var largoFiltro = $("#buscar").val();
    if (largoFiltro.length>=7) {
      var infoLocalidad = $("#formularioBusqueda").serialize();
      buscar(urlListar,infoLocalidad);
    }
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
    var attr = $("#nombreVisitante").attr("disabled");
    if (typeof attr == typeof undefined || attr == "false") {
        $("#formulario :input").prop("disabled", true);
        $("#formulario :button").removeAttr('disabled');
    } else {
      $("#formulario :input").removeAttr('disabled');
    }   
    
                                    
  });

</script>
@endsection
