<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Visitantes Dentro</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0" style="display: block;">
    <table class="table table-hover table-sm table-responsive">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Telefono</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($datos as $item)
          <tr>
            <td>{{ $item->nombreVisitante }}</td>
            <td>{{ $item->telefonoVisitante }}</td>
            <td>{{ $item->nombreEstado }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
