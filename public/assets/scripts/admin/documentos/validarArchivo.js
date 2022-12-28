function ValidarArchivo(file) {
  var imagefile = file.type;
  var match= ["image/jpeg","image/png","image/jpg"];
  if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
    mostrarMensaje();
    reiniciarCampo()
    return false;
  }
}
function mostrarMensaje() {
  toastr.error( 'Por favor seleccionar uno de los siguientes formatos (JPEG/JPG/PNG).',
  'Problema al Guardar',{ "positionClass": "toast-top-right","extendedTimeOut": "6000"}); 
}
function reiniciarCampo() {
    $("#foto").val('');
    $("#labelBorrable").html('');
}