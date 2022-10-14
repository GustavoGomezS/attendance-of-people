function buscarPuerta(url,datos) {
  $.ajax({
    type: "get",
    url: url,
    data: datos,
    success: function(data) 
    {  
      $('#datosPuerta').empty().html(data); 
    },
  });
}