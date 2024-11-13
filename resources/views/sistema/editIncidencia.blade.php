@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EDICIÓN DE INCIDENCIA</h1>
@stop

@section('content')
    <p>Modifique los campos que desea editar:</p>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('incidencias.update', $incidencia) }}" method="post">
                @csrf
                @method('put')
                
                {{-- Guía select --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-barcode {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <select name="guia" class="form-control @error('guia') is-invalid @enderror">
                        <option value="">Seleccione guía</option>
                        @foreach ($envios as $envio)
                            <option value="{{ $envio->guia }}" {{ $incidencia->guia == $envio->guia ? 'selected' : '' }}>
                                {{ $envio->guia }}
                            </option>
                        @endforeach
                    </select>
                    @error('guia')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Tipo field --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-tags {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <select name="tipo" class="form-control @error('tipo') is-invalid @enderror">
                        <option value="">Seleccione tipo</option>
                        <option value="Retraso" {{ $incidencia->tipo == 'Retraso' ? 'selected' : '' }}>Retraso</option>
                        <option value="Perdida" {{ $incidencia->tipo == 'Perdida' ? 'selected' : '' }}>Perdida</option>
                        <option value="Danio" {{ $incidencia->tipo == 'Danio' ? 'selected' : '' }}>Danio</option>
                    </select>
                </div>

                {{-- Monto field --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-dollar-sign {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <input type="number" name="monto" class="form-control @error('monto') is-invalid @enderror"
                           value="{{ $incidencia->monto }}" placeholder="Monto">
                    @error('monto')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Estado select --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-flag {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <select name="estado" class="form-control @error('estado') is-invalid @enderror">
                        <option value="">Seleccione estado</option>
                        <option value="1" {{ $incidencia->estado == 1 ? 'selected' : '' }}>Pagado</option>
                        <option value="2" {{ $incidencia->estado == 2 ? 'selected' : '' }}>Pendiente</option>
                    </select>
                    @error('estado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Fecha de Incidencia field --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-calendar-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <input type="date" name="fechaIncidencia" class="form-control @error('fechaIncidencia') is-invalid @enderror"
                           value="{{ $incidencia->fechaIncidencia }}">
                    @error('fechaIncidencia')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Fecha de Pago field --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-calendar-check {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <input type="date" name="fechaPago" class="form-control @error('fechaPago') is-invalid @enderror"
                           value="{{ $incidencia->fechaPago }}">
                    @error('fechaPago')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Notas field --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-sticky-note {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <textarea name="notas" class="form-control @error('notas') is-invalid @enderror" placeholder="Notas">{{ $incidencia->notas }}</textarea>
                    @error('notas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Register button --}}
                <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-save"></span>
                    Actualizar
                </button>
            </form>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    @if (session("message"))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session('message') }}";
                Swal.fire({
                    icon: 'success',
                    title: 'Resultado',
                    text: mensaje,
                    showConfirmButton: false,
                    timer: 1500
                })
            })
        </script>     
    @endif
@stop
