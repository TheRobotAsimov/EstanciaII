@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>LISTA DE MOVIENTOS</h1>
@stop

@section('content')
    <p>Aquí se muestra el listado de los movimientos</p>

    <div class="card">
        <div class="card-header">
            <x-adminlte-button label="Agregar" theme="primary" icon="fas fa-plus" class="float-right" data-toggle="modal" data-target="#modalCustom"/>
        </div>
        <div class="card-body">
            @php
            $heads = [
                'ID',
                'Tipo',
                'Subtipo',
                ['label' => 'Empleado', 'width' => 30],
                ['label' => 'Monto', 'width' => 30],
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
                @foreach($movimientos as $movimiento)
                    <tr>
                        <td>{{ $movimiento->id }}</td>
                        <td>{{ $movimiento->cSubTipo->cTipo->nombre }}</td>
                        <td>{{ $movimiento->cSubTipo->nombre }}</td>
                        <td>{{ $movimiento->empleado->usuario->nombre }}</td>
                        <td>{{ $movimiento->monto }}</td>
                        <td>
                            <a href="{{route('users.edit', $usuario)}}" class="mx-1 shadow btn btn-xs btn-default text-primary" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <form style="display: inline" action="{{route('users.destroy', $usuario)}}" method="post" class="formEliminar">
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

    <x-adminlte-modal id="modalCustom" title="Agregar Movimiento" size="lg" theme="blue"
    icon="fas fa-plus" v-centered static-backdrop scrollable>
        <div style="height:800px;">Complete los campos</div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="float-right" theme="success" label="Agregar"/>
        </x-slot>
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