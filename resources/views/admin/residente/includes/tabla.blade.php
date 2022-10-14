<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Residentes registrados para esta localidad</h3>
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
            <td>{{$item->documentoResidente}}</td>
            <td>{{$item->nombreResidente}} &nbsp {{$item->apellidoResidente}}</td>
            <td>{{$item->nombresector}} &nbsp {{$item->unidad}}</td>
            <td>{{$item->telefonoResidente}}</td>
            <td>{{$item->nombreEstado}}</td>          
            <td class="py-0 align-middle text-center">
              <div class="btn-group btn-group-sm">
                <a href="{{route('residente.editar',$item->id)}}" 
                  id="{{ $item->id }} " class="actualizar btn btn-info" value="{{route('residente.actualizar',$item->id)}}"
                  data-toggle="modal" data-target="#modal-lg">
                      <i class="fas fa-eye"></i>
                </a>
                <a href="{{route('residente.eliminar',$item->id)}}"  class="eliminar btn btn-danger" 
                    data-toggle="modal" data-target="#exampleModalCenter">
                      <i class="fas fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
        @endforeach</tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>