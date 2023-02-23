<form id="formularioBusqueda" method="get" autocomplete="off" class="form-inline">
  <div class="row col-lg-12">
    <div class="col-lg-5">
      <div class="form-group">
        <label for="fechaInicio" class="col-sm-2 col-form-label">Incio</label>
        <input type="date" name="fechaInicio" id="fechaInicio" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}"
          class="form-control col-sm-10">
      </div>
    </div>

    <div class="col-lg-5">
      <div class="form-group">
        <label for="fechaFin" class="col-sm-2 col-form-label">Fin</label>
        <input type="date" name="fechaFin" id="fechaFin" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}"
          class="form-control col-sm-10">
      </div>
    </div>

    <div class="col-lg-2">
      <button type="button" class="btn btn-info" id="buscar">Buscar</button>
    </div>
  </div>
</form>
