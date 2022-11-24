function buscarRegistro(url,datos) {
  $.ajax({
    type: "get",
    url: url,
    data: datos,
    success: function(data) 
    {  
      $('#datosRegistro').empty().html(data); 
    },
  });
}