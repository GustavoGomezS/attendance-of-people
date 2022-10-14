function rellenarSelectSectorBusqueda(url,datos) {
  $.ajax({
    type: "get",
    url: url,
    data: "formdata",
    dataType: "json",
    success: function (data) {
      $('.sectorBusqueda').html('');
      $(".sectorBusqueda").prepend("<option value='' seleted>Sector</option>");  
      $.each(data, function (indexInArray, valueOfElement) { 
        $(".sectorBusqueda").append("<option value="+valueOfElement.id+">"+valueOfElement.nombreSector+"</option>"); 
      });
       
    }
  }); 
}
