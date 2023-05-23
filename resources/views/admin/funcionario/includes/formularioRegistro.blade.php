<!-- /campo nombre,apellido,documento y fecha de nacimiento-->
<div class="row">
  <div class="col-lg-3 form-group">
    <label for="nombreFuncionario" class="col-lg-12 control-label requerido">Nombres</label>
    <input type="text" id="nombreFuncionario" name="nombreFuncionario" class="form-control" placeholder="Nombres"
      value="{{ old('nombreFuncionario') }}">
  </div>

  <div class="col-lg-3 form-group">
    <label for="apellidoFuncionario" class="col-lg-12 control-label requerido">Apellidos</label>
    <input type="text" id="apellidoFuncionario" name="apellidoFuncionario" class="form-control" placeholder="Apellidos"
      value="{{ old('apellidoFuncionario') }}">
  </div>

  <div class="col-lg-3 form-group">
    <label for="documentoFuncionario" class="col-lg-12 control-label requerido">Documento</label>
    <input type="number" id="documentoFuncionario" name="documentoFuncionario" class="form-control" placeholder="Documento"
      value="{{ old('documentoFuncionario') }}">
  </div>

  <div class="col-lg-3 form-group">
    <label for="fechaNacimientoFuncionario" class="col-lg-12 control-label ">Fecha de Nacimiento</label>
    <input type="date" id="fechaNacimientoFuncionario" name="fechaNacimientoFuncionario" class="form-control"
      value="{{ old('fechaNacimientoFuncionario') }}">
  </div>
</div>


<div class="row">
  <div class="col-lg-3 form-group">
    <label for="telefonoFuncionario" class="col-lg-12 control-label ">Telefono</label>
    <input type="number" id="telefonoFuncionario" name="telefonoFuncionario" class="form-control"
      placeholder="telefonoFuncionario" value="{{ old('telefonoFuncionario') }}">
  </div>

  <div class="col-lg-3 form-group">
    <label for="sexoFuncionario" class="col-lg-12 control-label ">Sexo</label>
    <select class="form-control " id="sexoFuncionario" name="sexoFuncionario">
      <option value="" disabled selected>Seleccion...</option>
      <option value="M">Mujer</option>
      <option value="H">Hombre</option>
    </select>
  </div>

  <div class="col-lg-3 form-group">
    <label for="sector" class="col-lg-12 control-label ">Sector</label>
    <select class="form-control sectorBusqueda" id="sector" name="sector">
    </select>
  </div>

  <div class="col-lg-3 form-group">
    <label for="localidad" class="col-lg-12 control-label ">Localidad</label>
    <select class="form-control localidadBusqueda" id="localidad" name="localidad">
    </select>
  </div>
</div>


<div class="row">
  
  <div class="col-lg-3 form-group">
    <label for="poderAutorizar" class="col-lg-12 control-label ">¿Puede Autorizar?</label>
    <select class="form-control" id="poderAutorizar" name="poderAutorizar">
      <option value="0" disabled selected>Seleccionar</option>
      <option value="1">Si</option>
      <option value="2">No</option>
      <option value="3">Siempre</option>
    </select>
  </div>

  <div class="form-group col-lg-3">
    <label for="foto" class="col-lg-12 control-label ">Foto</label>
    <div class="custom-file">
      <input type="file" id="foto" name="fotoFuncionario" class="custom-file-input" value="{{ old('foto') }}"
        accept="image/*">
      <label class="custom-file-label" for="foto" id="labelBorrable"></label>
    </div>
  </div>

  <div class="col-lg-3 form-group">
    <label for="horaEntrada" class="col-lg-12 control-label ">Hora de Entrada</label>
    <input type="time" id="horaEntrada" name="horaEntrada" class="form-control"
      value="{{ old('horaEntrada') }}">
  </div>

  <div class="col-lg-3 form-group">
    <label for="horaSalida" class="col-lg-12 control-label ">Hora de Salida</label>
    <input type="time" id="horaSalida" name="horaSalida" class="form-control"
      value="{{ old('horaSalida') }}">
  </div>
</div>

<div class="row">
  <div class="form-group col-lg-3">
    <label for="actDes" class="col-lg-12 control-label ">A/D</label>
    <a class="btn btn-info" id="actDes">
      <i class="fas fa-pen"></i>
    </a>
  </div>
</div>
{{-- tomar foto --}}
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
      <img src="{{ asset("assets/$theme/dist/img/boxed.jpg") }}" alt="foto de Funcionario" width="200" height="170"
        class="rounded border-bottom-0 border border-info" id="blah">
      <canvas id="canvas" width="200" height="170" class="border border-info"
        style="display: none"></canvas>
    </div>
  </div>
</div>
{{-- tomar foto --}}
@csrf
{{-- <script>
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
    enlace.download = "ImagenFuncionario.png";
    // Convertir la imagen a Base64 y ponerlo en el enlace
    enlace.href = dataUrl;
    // Hacer click en él
    enlace.click();
  });
</script>
 --}}