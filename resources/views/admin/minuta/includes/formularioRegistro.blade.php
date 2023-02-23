<div class="row">
  <div class="col-lg-12 form-group">
    <label for="comentario" class=" control-label ">Comentario</label>
    <textarea name="comentario" id="comentario" class="form-control" cols="12" rows="2"
      value="{{ old('comentario') }}"></textarea>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 form-group">
    <button type="submit" class="btn btn-info">
      Registrar Novedad
    </button>
  </div>
</div>

<input type="hidden" name="usuario" id="usuario" value="@auth{{ auth()->user()->id }} @endauth">
@csrf
