@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>LISTA DE EXPEDIENTES</h1>
@stop

@section('content')
    <p>Aquí se muestra el listado de los expedientes</p>

    <div class="card">
        <div class="card-header">
            <x-adminlte-button label="Nuevo expediente" theme="primary" icon="fas fa-plus" class="float-right" data-toggle="modal" data-target="#modalCustom"/>
        </div>
        <div class="card-body">
            @php
            $heads = [
                'ID',
                'Cliente',
                'Categoria',
                'Valor',
                ['label' => 'Acciones', 'no-export' => true, 'width' => 20],
            ];

            $btnDelete = '<button type="submit" class="mx-1 shadow btn btn-xs btn-default text-danger" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';
            $btnDetails = '<button class="mx-1 shadow btn btn-xs btn-default text-teal" title="Details">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </button>';

            $config = [
                'language' => ['url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json']
            ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach($expedientes as $expediente)
                    <tr>
                        <td>{{ $expediente->id }}</td>
                        <td>{{ $expediente->cliente->usuario->nombre }}</td>
                        <td>{{ $expediente->categoria->nombre }}</td>
                        <td>{{ $expediente->valor }}</td>
                        <td>
                            <a href="{{route('expedientes.edit', $expediente)}}" class="mx-1 shadow btn btn-xs btn-default text-primary" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <form style="display: inline" action="{{route('expedientes.destroy', $expediente)}}" method="post" class="formEliminar">
                                @csrf
                                @method('delete')
                                {!! $btnDelete !!}
                            </form>
                            {!! $btnDetails !!}
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>

    <x-adminlte-modal id="modalCustom" title="Agregar expediente" size="lg" theme="blue"
    icon="fas fa-plus" v-centered static-backdrop scrollable>
        <p>Complete los campos</p>
        <form action="{{route('expedientes.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="cliente">Cliente</label>
                <select name="cliente" id="cliente" class="form-control">
                    <option value="">Seleccione un cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->usuario->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria" class="form-control">
                    <option value="">Seleccione una categoria</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="text" name="valor" class="form-control" placeholder="Ingrese el valor">
            </div>
            <div class="form-group">
                <label for="notas">Notas</label>
                <textarea name="notas" id="notas" class="form-control" placeholder="Ingrese notas"></textarea>
            </div>
            <x-adminlte-button  type="submit" label="Agregar" theme="primary" icon="fas fa-plus" class="float-right"/>
        </form>
    </x-adminlte-modal>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('.formEliminar').submit(function(e){
                e.preventDefault();
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡Se eliminará un registro!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                        Swal.fire({
                        title: "¡Eliminado!",
                        text: "Your file has been deleted.",
                        icon: "success"
                        });
                    }
                });
            });
        })
    </script>

    
@stop