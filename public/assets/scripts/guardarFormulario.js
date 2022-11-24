function EnvioFormulario(datos,url,token,tipo){ 
  $.ajax({                        
    type: tipo,
    headers: {'X-CSRF-TOKEN':token},                
    url: url,                 
    data: datos,
    dataType : 'json',
    success: function(data)            
    {   
      AccionSucces();
    },
    error: function (data)
    {  
      try {
        var messages = data.responseJSON.errors;
        AccionError(messages);
      }
      catch(e) {
        var messages = {fallo : "error al procesar la solicitud"}
        AccionError(messages);
      }      
    }
  });

}