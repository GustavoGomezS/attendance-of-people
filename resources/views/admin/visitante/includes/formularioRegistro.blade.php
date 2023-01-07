<!-- /campo nombre,apellido,documento y fecha de nacimiento-->
<div class="row">
  <div class="col-lg-3 form-group">
    <label for="nombreVisitante" class="col-lg-12 control-label requerido">Nombres</label>
    <input type="text" id="nombreVisitante" name="nombreVisitante" class="form-control" placeholder="Nombres"
      value="{{ old('nombreVisitante') }}">
  </div>

  <div class="col-lg-3 form-group">
    <label for="apellidoVisitante" class="col-lg-12 control-label requerido">Apellidos</label>
    <input type="text" id="apellidoVisitante" name="apellidoVisitante" class="form-control" placeholder="Apellidos"
      value="{{ old('apellidoVisitante') }}">
  </div>

  <div class="col-lg-3 form-group">
    <label for="documentoVisitante" class="col-lg-12 control-label requerido">Documento</label>
    <input type="number" id="documentoVisitante" name="documentoVisitante" class="form-control" placeholder="Documento"
      value="{{ old('documentoVisitante') }}">
  </div>

  <div class="col-lg-3 form-group">
    <label for="fechaNacimientoVisitante" class="col-lg-12 control-label ">Fecha de Nacimiento</label>
    <input type="date" id="fechaNacimientoVisitante" name="fechaNacimientoVisitante" class="form-control"
      value="{{ old('fechaNacimientoVisitante') }}">
  </div>
</div>

<div class="row">
  <div class="col-lg-3 form-group">
    <label for="telefonoVisitante" class="col-lg-12 control-label ">Telefono</label>
    <input type="number" id="telefonoVisitante" name="telefonoVisitante" class="form-control"
      placeholder="telefonoVisitante" value="{{ old('telefonoVisitante') }}">
  </div>

  <div class="col-lg-3 form-group">
    <label for="sexoVisitante" class="col-lg-12 control-label ">Sexo</label>
    <select class="form-control " id="sexoVisitante" name="sexoVisitante">
      <option value="" disabled selected>Seleccion...</option>
      <option value="M">Mujer</option>
      <option value="H">Hombre</option>
    </select>
  </div>

  <div class="col-lg-3 form-group">
    <label for="foto" class="col-lg-12 control-label ">Foto</label>
    <div class="custom-file">
      <input type="file" id="foto" name="fotoVisitante" class="custom-file-input" value="{{ old('foto') }}"
        accept="image/*">
      <label class="custom-file-label" for="foto" id="labelBorrable"></label>
    </div>
  </div>

  <div class="col-lg-3 form-group">
    <label for="actDes" class="col-lg-12 control-label ">A/D</label>
    <a class="btn btn-info" id="actDes">
      <i class="fas fa-pen"></i>
    </a>
  </div>
</div>

<div class="d-flex justify-content-center bd-highlight ">
  <div class="p-2 bd-highlight">
    <!-- Stream video via webcam -->
    <div class="video-wrap" style="vertical-align: inherit;">
      <video id="video" class="rounded border-bottom-0 border border-info " playsinline autoplay></video>
    </div>
    <!-- Trigger canvas web API -->
    <button id="snap" class="btn btn-info block" type="button">Capturar</button>
  </div>

  <div class="p-2 bd-highlight">
    <div style="vertical-align: inherit;">
      <!-- Webcam video snapshot -->
      <img src="{{ asset("assets/$theme/dist/img/boxed.jpg") }}" alt="foto de Visitante" width="200" height="170"
        class="rounded border-bottom-0 border border-info" id="blah">
      <canvas id="canvas" width="200" height="170" class="border border-info" style="display: none"></canvas>
    </div>
  </div>
</div>
{{-- tomar foto --}}
@csrf
<script>
  'use strict';

  const video = document.getElementById('video');
  const canvas = document.getElementById('canvas');
  const snap = document.getElementById("snap");
  const errorMsgElement = document.querySelector('span#errorMsg');

  const constraints = {
    audio: false,
    video: {
      width: 200,
      height: 170
    }
  };

  // Access webcam
  async function init() {
    try {
      const stream = await navigator.mediaDevices.getUserMedia(constraints);
      handleSuccess(stream);
    } catch (e) {
      errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
    }
  }

  // Success
  function handleSuccess(stream) {
    window.stream = stream;
    video.srcObject = stream;
  }

  // Load init
  init();

  // Draw image
  var context = canvas.getContext('2d');
  snap.addEventListener("click", function() {

    context.drawImage(video, 0, 0, 200, 170);
    /* Convertir la imagen a Base64 */
    var dataUrl = canvas.toDataURL();
    let enlace = document.createElement('a');
    // El título
    enlace.download = "ImagenVisitante.png";
    // Convertir la imagen a Base64 y ponerlo en el enlace
    enlace.href = dataUrl;
    // Hacer click en él
    enlace.click();

  });
</script>
