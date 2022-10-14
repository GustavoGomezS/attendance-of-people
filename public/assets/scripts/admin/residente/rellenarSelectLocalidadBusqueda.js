function rellenarSelectLocalidadBusqueda(url,datos) {
  $.ajax({
    type: "get",
    url: url,
    data: datos,
    dataType: "json",
    success: function (data) {
      $('.localidadBusqueda').html('');
      $(".localidadBusqueda").prepend("<option value='' seleted>Localidad</option>");  
      $.each(data, function (indexInArray, valueOfElement) { 
        $(".localidadBusqueda").append("<option value="+valueOfElement.id+">"+valueOfElement.unidad+"</option>"); 
      }); 
    }
  }); 
}
