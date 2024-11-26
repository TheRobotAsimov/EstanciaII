<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detección de Posibles Fraudes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Detección de Posibles Fraudes</h1>
    
        <div class="shadow-sm card">
            <div class="text-white card-header bg-primary">
                <h2 class="mb-0 card-title">Reporte</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Envíos</th>
                            <th>Incidencias</th>
                            <th>Proporción</th>
                            <th>Tipos de Incidencias</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                            <tr @if ($cliente->ratio >= 50) style="background-color: #f8d7da; color: #721c24;" @endif>
                                <td>{{ $cliente->id }} - {{ $cliente->usuario->nombre }}</td>
                                <td>{{ $cliente->envios_count }}</td>
                                <td>{{ $cliente->incidencias_count }}</td>
                                <td>{{ number_format($cliente->ratio, 0) }}%</td>
                                <td>
                                    @if(isset($tiposIncidencias[$cliente->id]))
                                        <ul>
                                            @foreach($tiposIncidencias[$cliente->id] as $tipo => $cantidad)
                                                <li>{{ $tipo }}: {{ $cantidad }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        No hay incidencias
                                    @endif
                                </td>
                                <td>
                                    @if ($cliente->ratio >= 50)
                                        <span class="badge bg-danger">Posible Fraude</span>
                                    @elseif ($cliente->ratio >= 30)
                                        <span class="badge bg-warning">Alerta</span>
                                    @else
                                        <span class="badge bg-success">Sin Problemas</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
