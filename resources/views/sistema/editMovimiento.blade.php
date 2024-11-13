@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EDICIÓN DE MOVIMIENTOS</h1>
@stop

@section('content')
    <p>Modifique los campos que desea editar:</p>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('movimientos.update', $movimiento) }}" method="post">
                @csrf
                @method('put')
                
                {{-- Empleado select --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <select name="id_empleado" class="form-control @error('id_empleado') is-invalid @enderror">
                        <option value="">Seleccione empleado</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}" {{ $movimiento->id_empleado == $empleado->id ? 'selected' : '' }}>{{ $empleado->usuario->nombre }}</option>
                        @endforeach
                    </select>
                    @error('id_empleado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Subtipo select --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <select id="id_subtipo" name="id_subtipo" class="form-control @error('id_subtipo') is-invalid @enderror">
                        <option value="">Seleccione subtipo</option>
                        @foreach ($subtiposs as $subtipo)
                            {{-- Solo muestra los subtipos relacionados al tipo seleccionado por defecto --}}
                            <option value="{{ $subtipo->id }}" {{ $movimiento->id_c_sub_tipo == $subtipo->id ? 'selected' : '' }}>{{ $subtipo->nombre }}</option>
                        @endforeach
                    </select>
                    @error('id_subtipo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Monto field --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-dollar-sign {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <input type="number" name="monto" class="form-control @error('monto') is-invalid @enderror"
                           value="{{ $movimiento->monto }}" placeholder="Monto">
                    @error('monto')
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
                    <textarea name="notas" class="form-control @error('notas') is-invalid @enderror" placeholder="Notas">{{ $movimiento->notas }}</textarea>
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
                });
            });

        </script>     
    @endif
@stop
