<form id="formularioBusqueda" method="get" autocomplete="off" class="form-inline">
  <tr>
    <td colspan="4">
      <div class="form-group row mt-0 mb-0">
        <label for="fechaInicio" class="col-sm-2 col-form-label">Incio</label>
        <div class="col-sm-9">
          <input type="date"  name="fechaInicio" id="fechaInicio" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" class="form-control input">
        </div>
      </div>
    </td>

    <td colspan="2">
      <div class="form-group row mt-0 mb-0">
        <label for="fechaFin" class="col-sm-2 col-form-label">Fin</label>
        <div class="col-sm-9">
          <input type="date" name="fechaFin" id="fechaFin" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" class="form-control input">
        </div>
      </div>
    </td>
    
    <td>
      <button type="button" class="btn btn-info" id="buscar">Buscar</button>
    </td>
  </tr>
</form>
