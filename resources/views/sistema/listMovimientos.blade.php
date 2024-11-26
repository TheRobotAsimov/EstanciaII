@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.DateRangePicker', true)

@section('content_header')
    <h1>LISTA DE MOVIENTOS</h1>
@stop

@section('content')
    <p>Aquí se muestra el listado de los movimientos</p>

    <div class="card">
        <div class="card-header">
            <x-adminlte-button label="Nuevo Movimiento" theme="primary" icon="fas fa-plus" class="float-right m-3" data-toggle="modal" data-target="#modalCustom"/>
            <div class="m-3">
                <x-adminlte-date-range name="drCustomRanges" enable-default-ranges="Last 30 Days" id="daterange" value="{{ request('start') ? request('start').' - '.request('end') : '' }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </x-slot>
                </x-adminlte-date-range>
            </div>
            <div>
                <x-adminlte-button id="btnApplyFilter" label="Aplicar Filtro" theme="primary" icon="fas fa-filter" class="ml-3"/>
                <x-adminlte-button id="btnClearFilter" label="Limpiar Filtro" theme="danger" icon="fas fa-times" class="ml-3"/>
            </div>
            <x-adminlte-button id="btnGeneratePdf" label="Generar Reporte PDF" theme="warning" icon="fas fa-file-pdf" class="m-3 text-white"/>
        </div>
        <div class="card-body">
            @php
            $heads = [
                'ID',
                'Tipo',
                'Subtipo',
                'Empleado',
                'Monto',
                'Fecha',
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
                        <td>{{ $movimiento->subtipo->tipo->nombre }}</td>
                        <td>{{ $movimiento->subtipo->nombre }}</td>
                        <td>{{ $movimiento->empleado->usuario->nombre}}</td>
                        <td>{{ $movimiento->monto }}</td>
                        <td>{{ $movimiento->fecha }}</td>
                        <td>
                            <a href="{{route('movimientos.edit', $movimiento)}}" class="mx-1 shadow btn btn-xs btn-default text-primary" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <form style="display: inline" action="{{route('movimientos.destroy', $movimiento)}}" method="post" class="formEliminar">
                                @csrf
                                @method('delete')
                                {!! $btnDelete !!}
                            </form>
                            <button type="button" class="mx-1 shadow btn btn-xs btn-default text-teal btnDetails" data-toggle="modal" data-target="#notasModal" data-notas="{{ $movimiento->notas }}">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>

    <x-adminlte-modal id="modalCustom" title="Agregar Movimiento" size="lg" theme="blue"
    icon="fas fa-plus" v-centered static-backdrop scrollable>
        <p>Complete los campos</p>
        <form action="{{route('movimientos.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="subtipo">Subtipo</label>
                <select name="subtipo" id="subtipo" class="form-control">
                    <option value="">Seleccione un subtipo</option>
                    @foreach ($subtipos as $subtipo)
                        <option value="{{$subtipo->id}}">{{$subtipo->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="empleado">Empleado</label>
                <select name="empleado" id="empleado" class="form-control">
                    <option value="">Seleccione un empleado</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{$empleado->id}}">{{$empleado->id}} - {{$empleado->usuario->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="monto">Monto</label>
                <input type="number" name="monto" id="monto" class="form-control">
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="fecha">Notas</label>
                <textarea name="notas" id="notas" class="form-control"></textarea>
            </div>
            <x-adminlte-button  type="submit" label="Agregar" theme="primary" icon="fas fa-plus" class="float-right"/>
        </form>
    </x-adminlte-modal>

    <!-- Modal Details -->
    <div class="modal fade" id="notasModal" tabindex="-1" role="dialog" aria-labelledby="notasModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notasModalLabel">Notas del Movimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalNotas"></p>
                </div>
            </div>
        </div>
    </div>
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

        $(function () {
            $('#daterange').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY',
                    separator: ' - ',
                    applyLabel: 'Aplicar',
                    cancelLabel: 'Cancelar',
                    fromLabel: 'Desde',
                    toLabel: 'Hasta',
                    customRangeLabel: 'Rango personalizado',
                    weekLabel: 'S',
                    daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                    firstDay: 1
                },
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Últimos 7 Días': [moment().subtract(6, 'days'), moment()],
                    'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                    'Ultimos 3 Meses': [moment().subtract(3, 'month').startOf('month'), moment().endOf('month')],
                    'Ultimos 6 Meses': [moment().subtract(6, 'month').startOf('month'), moment().endOf('month')],
                    'Este Año': [moment().startOf('year'), moment().endOf('year')],
                }
            }).on('apply.daterangepicker', function (ev, picker) {
                selectedStart = picker.startDate.format('YYYY-MM-DD');
                selectedEnd = picker.endDate.format('YYYY-MM-DD');
            });

            $('#btnApplyFilter').on('click', function () {
                if (selectedStart && selectedEnd) {
                    window.location.href = `?start=${selectedStart}&end=${selectedEnd}`;
                } else {
                    alert('Por favor selecciona un rango de fechas antes de aplicar el filtro.');
                }
            });
        });

        $('#btnClearFilter').on('click', function () {
            window.location.href = window.location.pathname; // Recarga la página sin parámetros.
        });

        $('#btnGeneratePdf').on('click', function () {
            let params = new URLSearchParams(window.location.search);
            let url = '{{ route('movimientos.reporte') }}';

            if (params.toString()) {
                url += '?' + params.toString(); // Mantener los parámetros de rango de fechas si existen
            }

            window.open(url, '_blank');
        });

        $(document).ready(function() {
            $('.btnDetails').on('click', function() {
                var notas = $(this).data('notas');
                $('#modalNotas').text(notas);
            });
        });
    </script>
@stop