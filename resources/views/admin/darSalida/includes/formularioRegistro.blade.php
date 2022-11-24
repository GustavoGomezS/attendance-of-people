<div class="row">
  <!-- /campo puerta-->
  <div class="col-lg-12">
    {{-- campo puerta --}}
    <div class="form-group">
      <label for="puerta" class="control-label ">puerta</label>
      <select class="form-control " id="puerta" name="puerta" >
      </select>
    </div>
  </div>
</div>
<div class="row">
  {{-- campo comentario --}} 
  <div class="col-lg-12 ">
    <div class="form-group">
      <label for="comentario" class=" control-label ">Comentario</label>
      <textarea name="comentario" id="comentario" class="form-control" cols="12" rows="2"  value="{{old('comentario')}}"></textarea>
    </div>
  </div>
</div>
<input type="hidden" name="ingresoSalida" id="ingresoSalida" value="0">
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
