<table class="table">
  <thead>
    <tr>
      <th>id</th>
      <th>Nombre Puerta</th>
      <th class="text-center">#</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datos as $item)
      <tr>
        <th scope="row">
          {{$item->id}}
        </th>        
        <td>{{$item->nombrePuerta}}</td>
        <td class="text-right py-0 align-middle text-center">
          <div class="btn-group btn-group-sm">
            <a href="{{route('puerta.eliminar',$item->id)}}"  class="eliminar btn btn-danger" 
                data-toggle="modal" data-target="#exampleModalCenter">
                  <i class="fas fa-trash"></i>
            </a>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
