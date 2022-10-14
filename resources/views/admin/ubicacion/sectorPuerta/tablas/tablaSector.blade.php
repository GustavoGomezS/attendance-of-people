<table class="table">
  <thead>
    <tr>
      <th>id</th>
      <th>Nombre Sector</th>
      <th class="text-center">color</th>
      <th class="text-center">#</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datos as $item)
      <tr>
        <th scope="row">
          {{$item->id}}
        </th>        
        <td>{{$item->nombreSector	}}</td>
        <td class="text-center"><input type="color" disabled name="color" value="{{ $item->color }}" class="form-control"></td>
        <td class="text-right py-0 align-middle text-center">
          <div class="btn-group btn-group-sm">
            <a href="{{route('sector.eliminar',$item->id)}}"  class="eliminar btn btn-danger" 
                data-toggle="modal" data-target="#exampleModalCenter">
                  <i class="fas fa-trash"></i>
            </a>
          </div>
        </td>
      </tr>
    @endforeach  
  </tbody>
</table>
{{-- paginacion --}}
<div class="d-flex justify-content-end text-center">
    {{ $datos->links() }}
</div>