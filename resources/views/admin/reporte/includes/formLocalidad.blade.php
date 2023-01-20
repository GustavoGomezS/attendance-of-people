@php
date_default_timezone_set('UTC');
@endphp
<form id="formularioBusqueda" method="get" autocomplete="off" class="form-inline">
  <tr>
    <td colspan="3">
      <div class="form-group row mt-0 mb-0">
        <label for="fechaInicio" class="col-sm-2 col-form-label">Incio</label>
        <div class="col-sm-9">
          <input type="date" name="fechaInicio" id="fechaInicio" value="{{ date('Y-m-d') }}" class="form-control input">
        </div>
      </div>
    </td>

    <td colspan="2">
      <div class="form-group row mt-0 mb-0">
        <label for="fechaFin" class="col-sm-2 col-form-label">Fin</label>
        <div class="col-sm-9">
          <input type="date" name="fechaFin" id="fechaFin" value="{{ date('Y-m-d') }}" class="form-control input">
        </div>
      </div>
    </td>

    <td colspan="1">
      <div class="form-group row mt-0 mb-0 d-flex justify-content-between">
        <select name="idSector" id="idSector" class="form-control input sectorBusqueda col-lg-6">
        </select>

        <select name="idLocalidad" id="idLocalidad" class="form-control input localidadBusqueda col-lg-6">
        </select>
      </div>
    </td>


    <td>
      <button type="button" class="btn btn-info" id="buscar">Buscar</button>
    </td>
  </tr>
</form>
