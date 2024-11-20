@extends('adminlte::page')

@section('title', 'Resultado de Validación')

@section('content_header')
    <h1>Resultado de Validación del RFC</h1>
@stop

@section('content')
    @if(isset($data['status']) && $data['status'] === 'SUCCESS')
        <div class="alert alert-success">
            <strong>RFC:</strong> {{ $rfc }}<br>
            <strong>Curp:</strong> {{ $data['response']['curp'] }}<br>
            <strong>Email:</strong> {{ $data['response']['email'] }}<br>
            <strong>Nombre Completo:</strong> {{ $data['response']['nombreCompleto'] }}<br>
            <strong>Estatus:</strong> {{ $data['response']['estatus'] }}
        </div>
    @else
        <div class="alert alert-danger">
            <strong>Error:</strong> No se encontró información válida para el RFC {{ $rfc }}.
        </div>
    @endif
@stop
