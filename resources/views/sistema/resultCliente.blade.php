@extends('adminlte::page')

@section('title', 'Resultado de Validación')

@section('content_header')
    <h1>Resultado de Validación del RFC</h1>
@stop

@section('content')
    @if(isset($data['status']) && $data['status'] === 'SUCCESS')

        @if($cliente->estado == 'Validado')
            <div class="alert alert-success">
                <strong>Usted ha sido validado</strong>
            </div>
        @endif
    @else
        <div class="alert alert-danger">
            <strong>Error:</strong> No se encontró información válida para el RFC.
        </div>
    @endif
@stop
