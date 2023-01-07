<form id="formulario" method="post" autocomplete="off" class="form-inline">
  <div class="row col-lg-12">
    <div class="form-group col-lg-4">
      <label for="unidad" class="control-label col-lg-3">Unidad</label>
      <input type="text" value="" name="unidad" id="unidad" class="form-control col-lg-9">
    </div>

    <div class="form-group col-lg-3">
      <label for="sector" class="control-label col-lg-3">Sector</label>
      <div id="sector" class="col-lg-9"></div>
    </div>

    <div class="form-group col-lg-2">
      <button type="submit" class="btn btn-info" id="crear">Crear</button>
    </div>
  </div>
  @csrf
</form>
