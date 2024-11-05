@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ADMINISTRACIÓN DE CLIENTES</h1>
@stop

@section('content')
    <p>Ingrese la información del cliente</p>
    
    <div class="card">
        @if(session())
            @if(session('message') == 'ok')
                <x-adminlte-alert theme="success" title="¡Éxito!">
                    El cliente se ha guardado correctamente
                </x-adminlte-alert>
            @endif
        @endif

        <div class="card-body">
            <form action="{{route('clients.store')}}" method="post">
                @csrf
                {{-- With prepend slot --}}
                <x-adminlte-input type="text" name="nombre" label="NOMBRE" placeholder="Aquí ingrese el nombre" label-class="text-lightblue" value="{{old('nombre')}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
        
                {{-- With prepend slot --}}
                <x-adminlte-input type="text" name="apellido" label="APELLIDO" placeholder="Aquí ingrese el apellido" label-class="text-lightblue" value="{{old('apellido')}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            
                {{-- With prepend slot --}}
                <x-adminlte-input type="text" name="email" label="EMAIL" placeholder="Aquí ingrese el email" label-class="text-lightblue" value="{{old('email')}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-envelope text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            
                {{-- With prepend slot --}}
                <x-adminlte-input type="text" name="telefono" label="TELÉFONO" placeholder="7771234567" label-class="text-lightblue" value="{{old('telefono')}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-phone text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                
                {{-- With prepend slot, lg size, and label --}}
                <x-adminlte-select name="genero" label="GÉNERO" label-class="text-lightblue"
                igroup-size="lg">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fa fa-person-half-dress"></i>
                    </div>
                </x-slot>
                <option value="">Selecciona un género</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
        
                </x-adminlte-select>
        
                {{-- With prepend slot --}}
                <x-adminlte-input type="date" name="fecnac" label="FECHA DE NACIMIENTO" label-class="text-lightblue" value="{{old('fecnac')}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
        
                {{-- With prepend slot --}}
                <x-adminlte-input name="saldo" label="SALDO" label-class="text-lightblue" value="{{old('saldo')}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
        
                {{-- With prepend slot, lg size, and label --}}
                <x-adminlte-select name="estado" label="ESTADO" label-class="text-lightblue"
                igroup-size="lg">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fa fa-person-half-dress"></i>
                    </div>
                </x-slot>
                <option value="">Selecciona un estado</option>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
                </x-adminlte-select>
        
                <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save"/>
        
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