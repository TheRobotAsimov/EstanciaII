@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>AGREGAR EMPLEADO</h1>
@stop

@section('content')
    <p>Ingrese la información del empleado</p>
    
    <div class="card">

        <div class="card-body">
            <form action="{{route('users.store')}}" method="post">
                @csrf
        
                {{-- Name field --}}
                <div class="mb-3 input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>

                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') }}" placeholder="Nombre" autofocus>
        
        
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
                           value="{{ old('apellidos') }}" placeholder="{{ __('adminlte::adminlte.apellidos') }}">
        
                    @error('apellidos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Genero field --}}
                <div class="mb-3 input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-venus-mars {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <select name="genero" class="form-control @error('genero') is-invalid @enderror">
                        <option value="">Seleccione género</option>
                        <option value="Masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('genero') == 'femenino' ? 'selected' : '' }}>Femenino</option>
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
                           value="{{ old('telefono') }}" placeholder="{{ __('adminlte::adminlte.telefono') }}">
                    @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Fecha de Nacimiento field --}}
                <div class="mb-3 input-group">
                    <input type="date" name="fecnac" class="form-control @error('fecnac') is-invalid @enderror"
                           value="{{ old('fecnac') }}" placeholder="Fecha de Nacimiento">
                    
                    @error('fecnac')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Puesto field --}}
                <div class="mb-3 input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-briefcase {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <select name="puesto" class="form-control @error('puesto') is-invalid @enderror">
                        <option value="">Seleccione puesto</option>
                        <option value="Analisis" {{ old('puesto') == 'Analisis' ? 'selected' : '' }}>Analisis</option>
                        <option value="Desarrollo" {{ old('puesto') == 'Desarrollo' ? 'selected' : '' }}>Desarrollo</option>
                    </select>
                    @error('puesto')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Email field --}}
                <div class="mb-3 input-group">
                    
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>

                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
        
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Password field --}}
                <div class="mb-3 input-group">
                    
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>

                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="{{ __('adminlte::adminlte.password') }}">
        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Confirm password field --}}
                <div class="mb-3 input-group">
                    
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    
                    <input type="password" name="password_confirmation"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Register button --}}
                <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-user-plus"></span>
                    Registrar
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
    
@stop