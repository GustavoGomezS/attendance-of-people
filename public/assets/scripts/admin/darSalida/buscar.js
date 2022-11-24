 function buscar(url) {
  $.ajax({                        
      type: "GET",             
      url: url, 
      dataType: 'json',                   
      success: function(data)            
      {   
        $('#tablaDatos').DataTable({
          ajax: data,
        });   
      },
      error: function (data)
      {  

      }
  }); 
 }