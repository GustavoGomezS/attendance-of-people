function buscarSector(url,datos) {
  $.ajax({
    type: "get",
    url: url,
    data: datos,
    success: function(data) 
    {  
      $('#datosSector').empty().html(data); 
    },
  });
}