function Editar(url,id) {
  $.ajax({
    type: "get",
    url: url,          
    data: id,  
    dataType: 'json', 
    contentType : 'application/json',   
    success: function (data) {
      if (data.success=="true") {
        Rellenar(data.data[0]);
      }else{
        if (data.success=="false") {
          try {
            var messages = {messages : data.messages};
            AccionError(messages)
          } catch (error) {};
        }
      }
      
    },
    error: function (data)
    {  
      var messages = data.messages;
      AccionError(messages);
    }
  }); 
}

