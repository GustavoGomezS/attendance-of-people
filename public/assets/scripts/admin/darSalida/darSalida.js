function darSalida(url,datos) {
  $.ajax({
    type: "DELETE",
    url: url,
    data: datos,
    headers: {'X-CSRF-TOKEN':$("#token").val()},
    success: function(data) 
    {  
       
    },
  });
}