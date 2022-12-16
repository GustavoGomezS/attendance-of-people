const mostrarResidentesDeEstaLocalidad = (data)=>{
  $('#datos').empty().html(data); 
  $(".modal-header h4").text($(this).text());
  $(".modal-header").css({'background-color': $(this).css('background-color'), 'color' : 'white'});
}

const alertarSucces = (data)=>{
  toastr.success('Accion Realizada Correctamente', 'Exito', {
    "positionClass": "toast-top-right"
  });
}