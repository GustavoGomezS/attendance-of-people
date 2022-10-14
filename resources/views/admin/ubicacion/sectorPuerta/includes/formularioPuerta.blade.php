<form id="formularioPuerta" method="post" autocomplete="off" class="form-inline">
    <div class="row col-lg-12">
        <div class="form-group col-lg-10">
            <label for="nombre" class="control-label col-lg-3">Nombre Puerta</label>
            <input type="text" value="" name="nombre" id="nombre" class="form-control col-lg-9" >
        </div>        
        <div class="form-group col-lg-2">
            <button type="submit" class="btn btn-info" id="crear">Crear</button>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">    
</form>