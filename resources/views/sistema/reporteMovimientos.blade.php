<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Movimientos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Reporte de Movimientos</h1>
    
        <!-- Tabla de Ingresos -->
        <div class="mb-4 shadow-sm card">
            <div class="text-white card-header bg-success">
                <h2 class="mb-0 card-title">Ingresos</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Mes</th>
                            <th>Monto Total</th>
                            <th>Porcentaje</th>
                            @foreach($subtiposIngresos as $subtipo)
                                <th>{{ $subtipo }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalIngresos = $ingresosData->sum('monto_total');
                        @endphp
                        @foreach($ingresosData as $mes => $data)
                            <tr>
                                <td>{{ ucfirst($mes) }}</td>
                                <td>${{ number_format($data['monto_total'], 2) }}</td>
                                <td>{{ number_format(($data['monto_total'] / $totalIngresos) * 100, 0) }}%</td>
                                @foreach($subtiposIngresos as $subtipo)
                                    <td>{{ $data['subtipos'][$subtipo] ?? 0 }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        <!-- Fila de totales -->
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>${{ number_format($totalesIngresos['monto_total'], 2) }}</strong></td>
                            <td>100%</td>
                            @foreach($subtiposIngresos as $subtipo)
                                <td><strong>{{ $totalesIngresos['subtipos'][$subtipo] ?? 0 }}</strong></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
        <!-- Tabla de Egresos -->
        <div class="shadow-sm card">
            <div class="text-white card-header bg-danger">
                <h2 class="mb-0 card-title">Egresos</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Mes</th>
                            <th>Monto Total</th>
                            <th>Porcentaje</th>
                            @foreach($subtiposEgresos as $subtipo)
                                <th>{{ $subtipo }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalEgresos = $egresosData->sum('monto_total');
                        @endphp
                        @foreach($egresosData as $mes => $data)
                            <tr>
                                <td>{{ ucfirst($mes) }}</td>
                                <td>${{ number_format($data['monto_total'], 2) }}</td>
                                <td>{{ number_format(($data['monto_total'] / $totalEgresos) * 100, 0) }}%</td>
                                @foreach($subtiposEgresos as $subtipo)
                                    <td>{{ $data['subtipos'][$subtipo] ?? 0 }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        <!-- Fila de totales -->
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>${{ number_format($totalesEgresos['monto_total'], 2) }}</strong></td>
                            <td>100%</td>
                            @foreach($subtiposEgresos as $subtipo)
                                <td><strong>{{ $totalesEgresos['subtipos'][$subtipo] ?? 0 }}</strong></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>
