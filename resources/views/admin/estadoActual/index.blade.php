@extends("theme.$theme.layout")
@section('titulo')
  Estado Actual
@endsection
@section('metadata')
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-1">
    </div>
    <div class="col-lg-12">
      <div class="card card-info card-outline">
        <div class="card-body">
          @foreach ($datos as $sector_color => $unidad_totalPersonas)
            <?php
            $totalTorre = 0;
            $totalRecinto = 0;
            [$titulo, $color] = explode('#', $sector_color);
            ?>
            @if ($loop->index % 2 == 0)
              <div class="col-lg-12 row">
            @endif
            <div class="col-lg-6">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">{{ $titulo }}</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                  <table class="table table-hover table-sm table-responsive">
                    <tbody>
                      @foreach ($unidad_totalPersonas as $unidad => $totalPersonas)
                        @if ($loop->index % 8 == 0)
                          <tr></tr>
                        @endif
                        <td class="text-white" style="background-color: #{{ $color }}">
                          {{ $unidad }} &nbsp
                          @if ($totalPersonas != 0)
                            <span class="badge badge-primary badge-pill">{{ $totalPersonas }}</span>
                          @endif
                        </td>
                        <?php $totalTorre += $totalPersonas; ?>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="card-footer fixed">
                  {{ 'Personas en este Sector : ' . $totalTorre }}
                </div>
              </div>
              <?php $totalTorre = 0; ?>
              </table>
            </div>
            @if ($loop->index % 2 != 0 || $loop->last)
            </div>
            @endif
        @endforeach
      </div>
    </div>
  </div>
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      resaltarLinkEnHeader();
    });

    function resaltarLinkEnHeader() {
      $("#navItemEstadoActualLink").html("<strong>Estado Actual</strong>");
      $("#navItemEstadoActual").addClass("active");
    }
  </script>
@endsection
