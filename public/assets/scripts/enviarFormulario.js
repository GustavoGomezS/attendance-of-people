function EnviarFormulario(datos,url){ 
  let messages
  $.ajax({                        
    type: "post",
    headers: {'X-CSRF-TOKEN':$("#token").val()},                
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
        messages = data.responseJSON.errors;
        AccionError(messages);
      }
      catch(e) {
        messages = {fallo : "error al procesar la solicitud"}
        AccionError(messages);
      }      
    }
  });

}