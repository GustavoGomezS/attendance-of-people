 function eliminar(url) {
  $.ajax({                        
      type: "DELETE",
      headers: {'X-CSRF-TOKEN':$("#token").val()},                
      url: url, 
      dataType: 'json',                   
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