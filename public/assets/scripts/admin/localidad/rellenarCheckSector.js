function rellenarCheckSector(url) {
  $.ajax({
    type: "get",
    url: url,
    data: "formdata",
    dataType: "json",
    success: function (data) {
      $('#sector').html('');
      $.each(data, function (indexInArray, valueOfElement) { 
        if (valueOfElement.estadoSubCategoria!=2) {
          $("#sector").append("<div class='form-check float-left'><input class='form-check-input ' type='checkbox' name='sector[]' id="+valueOfElement.id+" value="+valueOfElement.id+"><label class='form-check-label' for="+valueOfElement.id+">"+valueOfElement.nombreSector+"</label></div>"); 
        }
      });   
    }
  }); 
}



    