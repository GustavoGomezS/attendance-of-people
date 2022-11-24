function listarVisitante(url,datos) {
  $.ajax({
    type: "get",
    url: url,
    data: datos,
    success: function(data) 
    {  
      $('#datosVisitante').empty().html(data); 
    },
  });
}