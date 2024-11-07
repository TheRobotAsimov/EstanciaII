@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EDICIÓN DE CLIENTE</h1>
@stop

@section('content')
    <p>Modifique los campos que desea editar:</p>

    <div class="card">

        <div class="card-body">
            <form action="{{route('users.update', $usuario)}}" method="post">
                @csrf
                @method('put')
                {{-- Name field --}}
                <div class="mb-3 input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>

                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ $usuario->nombre }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
        
        
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Apellidos field --}}
                <div class="mb-3 input-group">
                    
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>

                    <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror"
                           value="{{ $usuario->apellidos }}" placeholder="{{ __('adminlte::adminlte.apellidos') }}">
        
                    @error('apellidos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Genero field --}}
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-venus-mars {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <select name="genero" class="form-control @error('genero') is-invalid @enderror">
                        <option value="">Seleccione género</option>
                        <option value="Masculino" {{ $usuario->genero == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ $usuario->genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                    @error('genero')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Telefono field --}}
                <div class="mb-3 input-group">
                    
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    
                    <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                           value="{{ $usuario->telefono }}" placeholder="{{ __('adminlte::adminlte.telefono') }}">
                    @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Fecha de Nacimiento field --}}
                <div class="input-group mb-3">
                    <input type="date" name="fecnac" class="form-control @error('fecnac') is-invalid @enderror"
                           value="{{ $usuario->fecnac }}" placeholder="Fecha de Nacimiento">
                    
                    @error('fecnac')
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
                let mensaje = "{{session('message')}}";
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