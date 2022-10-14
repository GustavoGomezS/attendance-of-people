
function Editar(url,id) {
  $.ajax({
    type: "get",
    url: url,
    data: id,
    dataType: "json",
    success: function (data) {
      Rellenar(data.data[0]);
    }
  }); 
    
}