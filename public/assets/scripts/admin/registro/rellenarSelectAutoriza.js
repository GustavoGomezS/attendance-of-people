function rellenarSelectAutoriza(url,datos) {
  $.ajax({
    type: "get",
    url: url,
    data: datos,
    dataType: "json",
    success: function (data) {
      $('#autorizaResidente').html('');
      $("#autorizaResidente").prepend("<option value='' seleted>Residente</option>");  
      $.each(data, function (indexInArray, valueOfElement) { 
        $("#autorizaResidente").append("<option value="+valueOfElement.id+">"+valueOfElement.nombreResidente+" "+valueOfElement.apellidoResidente+"</option>"); 
      });
       
    }
  }); 
}
