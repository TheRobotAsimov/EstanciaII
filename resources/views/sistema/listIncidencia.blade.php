@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>LISTA DE INCIDENCIAS</h1>
@stop

@section('content')
    <p>Aquí se muestra el listado de los incidencias</p>

    <div class="card">
        <div class="card-header">
            <x-adminlte-button label="Nuevo incidencia" theme="primary" icon="fas fa-plus" class="float-right" data-toggle="modal" data-target="#modalCustom"/>
        </div>
        <div class="card-body">
            @php
            $heads = [
                'ID',
                'Guia',
                'Tipo',
                'Monto',
                'Estado',
                'Fecha Incidencia',
                'Fecha Pago',
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
                @foreach($incidencias as $incidencia)
                    <tr>
                        <td>{{ $incidencia->id }}</td>
                        <td>{{ $incidencia->guia }}</td>
                        <td>{{ $incidencia->tipo }}</td>
                        <td>{{ $incidencia->monto }}</td>
                        <td>{{ $incidencia->estado == 1 ? 'Pagado' : 'Pendiente' }}</td>
                        <td>{{ $incidencia->fechaIncidencia }}</td>
                        <td>{{ $incidencia->fechaPago }}</td>
                        <td>
                            <a href="{{route('incidencias.edit', $incidencia)}}" class="mx-1 shadow btn btn-xs btn-default text-primary" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <form style="display: inline" action="{{route('incidencias.destroy', $incidencia)}}" method="post" class="formEliminar">
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

    <x-adminlte-modal id="modalCustom" title="Agregar incidencia" size="lg" theme="blue"
    icon="fas fa-plus" v-centered static-backdrop scrollable>
        <p>Complete los campos</p>
        <form action="{{route('incidencias.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="guia">Guia</label>
                <select name="guia" id="guia" class="form-control">
                    <option value="">Seleccione una guia</option>
                    @foreach ($envios as $envio)
                        <option value="{{$envio->guia}}">{{$envio->guia}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="">Seleccione un empleado</option>
                    <option value="Retraso">Retraso</option>
                    <option value="Perdida">Perdida</option>
                    <option value="Danio">Danio</option>
                </select>
            </div>
            <div class="form-group">
                <label for="monto">Monto</label>
                <input type="number" name="monto" id="monto" class="form-control">
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="">Seleccione un estado</option>
                    <option value="1">Pagado</option>
                    <option value="2">Pendiente</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fechaIncidencia">Fecha Incidencia</label>
                <input type="date" name="fechaIncidencia" id="fechaIncidencia" class="form-control">
            </div>
            <div class="form-group">
                <label for="fechaPago">Fecha Pago</label>
                <input type="date" name="fechaPago" id="fechaPago" class="form-control">
            </div>
            <div class="form-group">
                <label for="fecha">Notas</label>
                <textarea name="notas" id="notas" class="form-control"></textarea>
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