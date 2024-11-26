@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>VALIDACIÓN</h1>
@stop

@section('content')

    @if ($cliente->isEmpty())
        <div class="alert alert-danger" role="alert">
            No ha iniciado sesión como cliente
        </div>
    @else
        <form action="{{ route('clientes.comprobar') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="rfc">RFC del Cliente:</label>
                <input type="text" name="rfc" id="rfc" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Comprobar</button>
        </form>
    @endif


@stop

@section('js')
    @if ($errors->has('rfc'))
    <script>
        alert("{{ $errors->first('rfc') }}");
    </script>
    @endif
@stop