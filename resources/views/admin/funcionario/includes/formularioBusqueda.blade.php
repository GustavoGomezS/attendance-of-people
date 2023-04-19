<form id="formularioBusqueda" method="get" autocomplete="off" class="form-inline">
  <div class="row  col-lg-12">
    <div class="form-group col-lg-4">
      <label for="filtro" class="control-label col-lg-3">Filtro</label>
      <select name="filtro" id="filtro" class="form-control col-lg-9">
        <option value="0">Sin filtro</option>
        <option value="documentoFuncionario">Documento</option>
        <option value="telefonoFuncionario">Telefono</option>
        <option value="nombreFuncionario">Nombre</option>
      </select>
    </div>

    <div class="form-group col-lg-6">
      <label for="buscar" class="control-label col-lg-3">Buscar</label>
      <input type="text" value="" name="buscar" id="buscar" class="form-control col-lg-9"
        placeholder="Buscar Funcionario">
    </div>
  </div>
</form>
