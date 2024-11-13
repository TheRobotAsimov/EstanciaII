@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EDICIÓN DE EXPEDIENTE</h1>
@stop

@section('content')
    <p>Modifique los campos que desea editar:</p>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('expedientes.update', $expediente) }}" method="post">
                @csrf
                @method('put')
                
                {{-- Cliente select --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <select name="id_cliente" class="form-control @error('id_cliente') is-invalid @enderror">
                        <option value="">Seleccione cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $expediente->id_cliente == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->usuario->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_cliente')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Categoría select --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-folder {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <select name="id_c_categoria" class="form-control @error('id_c_categoria') is-invalid @enderror">
                        <option value="">Seleccione categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $expediente->id_c_categoria == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_c_categoria')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Valor field --}}
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-pencil-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    <textarea name="valor" class="form-control @error('valor') is-invalid @enderror" placeholder="Valor del expediente">{{ $expediente->valor }}</textarea>
                    @error('valor')
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
                    <textarea name="notas" class="form-control @error('notas') is-invalid @enderror" placeholder="Notas">{{ $expediente->notas }}</textarea>
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
