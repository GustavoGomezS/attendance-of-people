function EnvioFormulario(datos,url,token,tipo){ 
  $.ajax({                        
    type: tipo,
    headers: {'X-CSRF-TOKEN':token},                
    url: url,                 
    data: datos,
    success: function(data)            
    {   
      AccionSucces();
    },
    error: function (data)
    {  
      var messages = data.responseJSON.errors;
      AccionError(messages);
    }
  });

}