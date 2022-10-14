function EnvioFormulario(datos,urlFormulario,token,tipo) {
  $.ajax({
    type: 'POST',
    headers: {'X-CSRF-TOKEN':token}, 
    url: urlFormulario,
    data: datos,
    contentType: false,
    datatType: 'json',
    cache: false,
    processData:false,
    success: function(data)            
    {   
      console.log("guardo exitosamente");
      toastr.success( 'Creado Exitosamente', 'Exito',{
      "positionClass": "toast-top-right"})
      /* Cerrar modal y reiniciar inputs */
      $("#cerrarModal").trigger('click');
      document.getElementById("formulario").reset();                   
      //esperar 0,7 segundos para actualizar la tabla
      setTimeout(function(){
        buscar(urlListar);
      },700);
    },
    error: function (data)
    {  
      console.log("Error al guardar"); 
      $("#list").val('');
      var messages = data.responseJSON.errors;
      $.each(messages, function(index, val) {
          toastr.error( val, 'Problema al Guardar',{
          "positionClass": "toast-top-right",
          "extendedTimeOut": "6000"})   
      });
    }
  });
}