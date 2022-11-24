<div class="row">
  <div class="col-lg-12 text-center">
    <div class="form-group">
        <img src="{{asset("assets/$theme/dist/img/boxed.jpg")}}" alt="foto de residente" width="200" height="170" class="rounded border-bottom-0 border border-info" id="blah">
        <h5><strong id="nombreVisitante" class="mt-2"></strong></h5>
        <div class="input-group mt-2">
          <input type="search" class="form-control" placeholder="Documento del Visitante" value="" id="docVisitante">
          <div class="input-group-append">
            <button type="button" class="btn btn-default" id="btnVisitante">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </div>
  </div>
</div>
<div class="row">
  <!-- /campo autoriza y puerta-->
  <div class="col-lg-6">
    {{-- campo autoriza --}}
    <div class="form-group">
      <label for="autorizaResidente" class="control-label ">Autoriza</label>
      <select class="form-control " id="autorizaResidente" name="autorizaResidente" >
      </select>
    </div>
  </div>
  <div class="col-lg-6">
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
<input type="hidden" name="ingresoSalida" id="ingresoSalida" value="1">
<input type="hidden" name="visitante" id="visitante" value="">
<input type="hidden" name="idLocalidad" id="idLocalidad" value="">
<input type="hidden" name="autorizaSeguridad" id="autorizaSeguridad" value="@auth{{ auth()->user()->id}}@endauth">
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
