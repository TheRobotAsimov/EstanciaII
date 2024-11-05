@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EDICIÓN DE CLIENTE</h1>
@stop

@section('content')
    <p>Modifique los campos que desea editar:</p>

    <div class="card">



        <div class="card-body">
            <form action="{{route('clients.update', $cliente)}}" method="post">
                @csrf
                @method('put')
                {{-- With prepend slot --}}
                <x-adminlte-input type="text" name="nombre" label="NOMBRE" label-class="text-lightblue" value="{{$cliente->nombre}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
        
                {{-- With prepend slot --}}
                <x-adminlte-input type="text" name="apellido" label="APELLIDO" label-class="text-lightblue" value="{{$cliente->apellido}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            
                {{-- With prepend slot --}}
                <x-adminlte-input type="text" name="email" label="EMAIL" label-class="text-lightblue" value="{{$cliente->email}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-envelope text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            
                {{-- With prepend slot --}}
                <x-adminlte-input type="text" name="telefono" label="TELÉFONO" label-class="text-lightblue" value="{{$cliente->telefono}}">
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
                <option value="{{$cliente->genero}}">{{$cliente->genero}}</option>
                <option value="">Selecciona un género</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
        
                </x-adminlte-select>
        
                {{-- With prepend slot --}}
                <x-adminlte-input type="date" name="fecnac" label="FECHA DE NACIMIENTO" label-class="text-lightblue" value="{{$cliente->fecnac}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
        
                {{-- With prepend slot --}}
                <x-adminlte-input name="saldo" label="SALDO" label-class="text-lightblue" value="{{$cliente->saldo}}">
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
                <option value="{{$cliente->estado}}">{{$cliente->estado}}</option>
                <option value="">Selecciona un estado</option>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
                </x-adminlte-select>
        
                <x-adminlte-button type="submit" label="Actualizar" theme="primary" icon="fas fa-save"/>
        
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