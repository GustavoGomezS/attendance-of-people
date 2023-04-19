<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Funcionarios registrados para esta localidad</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0" style="display: block;">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>id</th>
          <th>Documento</th>
          <th>Nombre</th>
          <th>Localidad</th>
          <th>Telefono</th>
          <th>Estado</th>
          <th class="text-center">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($datos as $item)  
          <tr>
            <th scope="row">
              {{$item->id}}
            </th>        
            <td>{{$item->documentoFuncionario}}</td>
            <td>{{$item->nombreFuncionario}} &nbsp {{$item->apellidoFuncionario}}</td>
            <td>{{$item->nombreSector}} -  {{$item->unidad}}</td>
            <td>{{$item->telefonoFuncionario}}</td>
            <td>{{$item->nombreEstado}}</td>          
            <td class="py-0 align-middle text-center">
              <div class="btn-group btn-group-sm">
                @can('esAdmin')
                <a href="{{route('funcionario.editar',$item->id)}}" 
                  id="{{ $item->id }} " class="actualizar btn btn-info" value="{{route('funcionario.actualizar',$item->id)}}"
                  data-toggle="modal" data-target="#modal-lg">
                      <i class="fas fa-eye"></i>
                </a>
                <a  href="{{route('funcionario.desactivar',$item->id)}}"
                  @if ($item->estadoFuncionario==2) 
                    class="desactivar btn btn-danger"
                  @else 
                    class="desactivar btn btn-success"
                  @endif
                    data-toggle="modal"
                    data-target="#exampleModalCenter">
                  <i class="fas fa-check-circle"></i>
                </a>
                @endcan
              </div>
            </td>
          </tr>
        @endforeach</tbody>
    </table>
    {{-- paginacion --}}
    <div class="d-flex justify-content-end text-center">
      {{ $datos->links() }}
    </div>
  </div>
  <!-- /.card-body -->
</div>