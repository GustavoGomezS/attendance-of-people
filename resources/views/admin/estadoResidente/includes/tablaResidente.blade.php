<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>Foto</th>
      <th>Nombre</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datos as $item)
      <tr>
        <td>
          <div class="image-container">
            <img class="image-zoom" height="100" width="100" src="{{ asset($item->fotoResidente) }}"
              alt="foto residente" data-zoom="{{ asset($item->fotoResidente) }}">
            <div class="image-details"></div>
          </div>
        </td>
        <td>
          {{ $item->nombreResidente }}
        </td>
        <td>
          <form class="formulario" enctype="multipart/form-data">
            <input type="hidden" name="idResidente" value="{{ $item->id }}">
            <div class="form-group">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input estadoResidente" name="estadoResidente"
                  id="customSwitch{{ $item->id }}" @if ($item->estadoResidente == '3') {{ 'checked' }} @endif>
                <label class="custom-control-label" for="customSwitch{{ $item->id }}">Fuera/Dentro</label>
              </div>
            </div>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<script>
  $(document).ready(function() {
    $('.image-zoom')
      .wrap('<span style="display:inline-block"></span>')
      .css('display', 'block')
      .parent()
      .zoom({
        url: $(this).find('img').attr('data-zoom')
      });
  });
</script>
