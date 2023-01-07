<div class="row">
  <div class="col-lg-12 form-group">
    <label for="puerta" class="control-label ">puerta</label>
    <select class="form-control " id="puerta" name="puerta">
    </select>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 form-group">
    <label for="comentario" class="control-label ">Comentario</label>
    <textarea name="comentario" id="comentario" class="form-control" cols="12" rows="2"
      value="{{ old('comentario') }}"></textarea>
  </div>
</div>
<input type="hidden" name="ingresoSalida" id="ingresoSalida" value="0">
@csrf
