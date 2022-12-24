const mostrarResidentesDeEstaLocalidad = (data)=>{
  $('#datos').empty().html(data); 
}

const alertarSucces = (data)=>{
  toastr.success('Accion Realizada Correctamente', 'Exito', {
    "positionClass": "toast-top-right"
  });
}