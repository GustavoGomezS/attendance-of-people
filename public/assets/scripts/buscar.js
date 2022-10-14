function buscar(url,datos) {
  $.ajax({
    type: "get",
    url: url,
    data: datos,
    success: function(data) 
    {  
      $('#datos').empty().html(data); 
    },
  });
}