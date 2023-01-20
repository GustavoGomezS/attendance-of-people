const rellenarSelectSectores = (data) => {
  $('.sectorBusqueda').html('');
  $('.sectorBusqueda').css('color', 'white');
  $(".sectorBusqueda").prepend("<option value='0' id='optionDefault' style='background-color : #030203'>Sector</option>");  
  $.each(data, function (indexInArray, valueOfElement) { 
    $(".sectorBusqueda").append("<option value="+valueOfElement.id+" style=' background-color :"+valueOfElement.color+"'>"+valueOfElement.nombreSector+"</option>"); 
  });
  $("#idSector").val("0");
  $("#idSector").change();
}

const rellenarSelectLocalidades = (data) => {
    $('.localidadBusqueda').html('');
    $('.localidadBusqueda').css('background-color', data[0].color);
    $('.localidadBusqueda').css('color', 'white');
    $(".localidadBusqueda").prepend("<option value='' seleted >Localidad</option>");  
    $.each(data, function (indexInArray, valueOfElement) { 
      $(".localidadBusqueda").append("<option value="+valueOfElement.id+">"+valueOfElement.unidad+"</option>"); 
    }); 
}

const mostrarregistros = (data) => {
  console.log(data); 
}
