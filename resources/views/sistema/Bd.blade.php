@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EDICIÓN DE MOVIMIENTOS</h1>
@stop

@section('content')
    <div class="container">
        <div class="row m-3">
            <div class="col-md-6">
                <form action="{{ route('bd.backup') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Generar Respaldo</button>
                </form>
            </div>
            <div class="col-md-6">
                <form action="{{ route('bd.restore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="backup_file">Subir Respaldo</label>
                        <input type="file" class="form-control" id="backup_file" name="backup_file" required>
                    </div>
                    <button type="submit" class="btn btn-success">Restaurar Base de Datos</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    @if(session('message'))
        alert('{{ session('message') }}');
    @endif
    @if(session('error'))
        alert('{{ session('error') }}');
    @endif
</script>
@stop