@extends("theme.$theme.layout")
@section('titulo')
Localidades
@endsection
@section('metadata')
<meta name="csrf-token" content="{{csrf_token()}}"/> 
<script src="{{asset("assets/scripts/admin/localidad/rellenarCheckSector.js")}}"></script> 
<script src="{{asset("assets/scripts/guardarFormulario.js")}}"></script> 
<script src="{{asset("assets/scripts/buscar.js")}}"></script> 
<script src="{{asset("assets/scripts/eliminar.js")}}"></script> 
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header border-0">
          @include('admin/ubicacion/localidad/includes/formulario')
        </div>
        <div class="card-body table-responsive p-0">
          <div id="datos"></div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
  @include('admin/includes/modalConfirmDelet')
<script>
  const urlGuardar = "{{route('localidad.guardar')}}";
  const urlBuscar = "{{route('localidad.listar')}}";
  const urlCheckSector = "{{route('localidad.checkSector')}}";
  var data,tipo,datos={a:"a"};
  var token = $("#token").val();
  
  function AccionSucces() {
    toastr.success( 'Accion Realizada Correctamente', 'Exito',{
      "positionClass": "toast-top-right"});
    buscar(urlBuscar, datos);
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
  /* Buscar al cargar la pagina*/
  $(document).ready(function () {
    $("#ubicacionesLi").addClass("menu-open");;
    $("#ubicacionesA").addClass("active");
    $("#localidad").addClass("active");
    rellenarCheckSector(urlCheckSector);
    buscar(urlBuscar, datos);
  });
    /* registro del formulario */
  $('#formulario').on('submit', function(e){
    e.preventDefault();
    data = $("#formulario").serialize();
    tipo = "post";
    EnvioFormulario(data,urlGuardar,token,tipo);                    
  });
    /* Eliminar elementos de la lista */   
  $(document).on("click",".eliminar",function(e){
    e.preventDefault();   
    urlEliminar = $(this).attr("href");                                      
  });
  $('#confirmar').on('click', function(){
    eliminar(urlEliminar);
  });
</script>
@endsection






