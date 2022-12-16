class AsyncFunction {
  constructor(url, datos, accionExitosa, accionAlFallar) {
    this.url = url;
    this.datos = datos;
    this.accionExitosa = accionExitosa;
    this.accionAlFallar = accionAlFallar;
  }

  set Datos(val){
    this.datos = val;
  }
  
  get Datos(){
     return this.datos;
  }
  set Url(val){
    this.url = val;
  }
  
  get Url(){
     return this.url;
  }

  ObtenerDatosDe(accionExitosa = this.accionExitosa) {
  $.get( this.url, this.datos )
    .done(function( data ) {
      try {
        accionExitosa(data);
      } catch (error) {
        console.log("sin accion");
      }
    })
    .fail(function(xhr, status, error) {
      console.log(status, error);
    });
  }

  Guardar(accionExitosa = this.accionExitosa, accionAlFallar = this.accionAlFallar) {
    $.ajax({                        
      type: "post",
      headers: {'X-CSRF-TOKEN':$("#token").val()},                
      url: this.url,                 
      data: this.datos,
      dataType : 'json',
    })
    .done(function( data ) {
      if (data.success == true) {accionExitosa()}      
      else if(data.success == false) {accionAlFallar(data)}
    })
    .fail(function(data) {
      let messages = data.responseJSON.errors;
      accionAlFallar(messages);
    });
  }

  Eliminar(accionExitosa = this.accionExitosa, accionAlFallar = this.accionAlFallar){
    $.ajax({
    type: "delete",
    url: this.url,                 
    data: this.datos,
    headers: {'X-CSRF-TOKEN':$("#token").val()}
    })
    .done(function( data ) {
      accionExitosa(data)   
    })
    .fail(function(data) {
      let messages = data.responseJSON.errors;
      accionAlFallar(messages);
    });

  }

}