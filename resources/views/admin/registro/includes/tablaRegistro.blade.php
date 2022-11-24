<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Registro (Hoy)</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0" style="display: block;">
    <table class="table table-hover table-sm">
      <thead>
        <tr>
          <th>Visitante</th>
          <th>Telefono V.</th>
          <th>Ing/Sal</th>
          <th>Autorizó</th>
          <th>Comentario</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($datos as $item)  
          <tr>       
            <td>{{$item->nombreVisitante}}</td>
            <td>{{$item->telefonoVisitante}}</td>
            <td>
              @if ($item->ingresoSalida == 1)
                {{"Ingreso"}} 
              @else
                {{"Salida"}}
              @endif
            </td>          
            <td>{{$item->nombreResidente}}</td>          
            <td>{{$item->comentario}}</td>          
            <td>{{$item->created_at}}</td>          
          </tr>
        @endforeach</tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>