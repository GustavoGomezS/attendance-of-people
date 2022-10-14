  function readURL(input) {
    if (input.files && input.files[0]) { //Revisamos que el input tenga contenido
      var reader = new FileReader(); //Leemos el contenido
      reader.onload = function(e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
        $('#blah').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }