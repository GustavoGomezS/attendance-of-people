class AsyncFunction {
  constructor(url, datos, accionExitosa, accionAlFallar) {
    this._url = url;
    this._datos = datos;
    this._accionExitosa = accionExitosa;
    this._accionAlFallar = accionAlFallar;
  }

  set datos(val){
    this._datos = val;
  }
  get datos(){
     return this._datos;
  }

  set url(val){
    this._url = val;
  }  
  get url(){
     return this._url;
  }
}

class GetAsyncFunction extends AsyncFunction {
  ObtenerDatosDe(accionExitosa = this._accionExitosa) {
  $.get( this._url, this._datos )
    .done(function( data ) {
      try {
        accionExitosa(data);
      } catch (error) {
        console.log(error);
      }
    })
    .fail(function(xhr, status, error) {
      console.log(status, error);
    });
  }
}

class PostAsyncFunction extends AsyncFunction {
  Guardar(accionExitosa = this._accionExitosa, accionAlFallar = this._accionAlFallar) {
    $.ajax({                        
      type: "post",
      headers: {'X-CSRF-TOKEN':$("#token").val()},                
      url: this._url,                 
      data: this._datos,
      contentType: false,
      dataType : 'json',
      cache: false,
      processData:false,
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
}

class DeleteAsyncFunction extends AsyncFunction {
  Eliminar(accionExitosa = this._accionExitosa, accionAlFallar = this._accionAlFallar){
    $.ajax({
    type: "delete",
    url: this._url,                 
    data: this._datos,
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

class PutAsyncFunction extends AsyncFunction {
  Actualizar(accionExitosa = this._accionExitosa, accionAlFallar = this._accionAlFallar){
    $.ajax({
    type: "put",
    url: this._url,                 
    data: this._datos,
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