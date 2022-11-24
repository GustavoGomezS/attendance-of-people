function rellenarSelectPuerta(url,datos) {
  $.ajax({
    type: "get",
    url: url,
    data: datos,
    dataType: "json",
    success: function (data) {
      $('#puerta').html('');
      $.each(data, function (indexInArray, valueOfElement) { 
        $("#puerta").append("<option value="+valueOfElement.id+">"+valueOfElement.nombrePuerta+"</option>"); 
      }); 
    }
  }); 
}
