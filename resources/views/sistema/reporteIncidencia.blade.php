<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Incidencias</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Reporte de Incidencias</h1>
    
        <div class="shadow-sm card">
            <div class="text-white card-header bg-primary">
                <h2 class="mb-0 card-title">Reporte Mensual</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Mes</th>
                            <th>Monto</th>
                            <th>Porcentaje</th>
                            <th>Retrasos</th>
                            <th>Pérdidas</th>
                            <th>Daños</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = array_sum($chartData['values']);
                        @endphp
                        @foreach($chartData['labels'] as $index => $label)
                        <tr @if($label === $maxLabel) style="background-color: #f8d7da; color: #721c24;" @endif>
                                <td>{{ ucfirst($label) }}</td>
                                <td>${{ number_format($chartData['values'][$index], 2) }}</td>
                                <td>{{ number_format(($chartData['values'][$index] / $total) * 100, 2) }}%</td>
                                <td>{{ $countsByType[$label]['retraso'] ?? 0 }}</td>
                                <td>{{ $countsByType[$label]['perdida'] ?? 0 }}</td>
                                <td>{{ $countsByType[$label]['danio'] ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td>Total</td>
                            <td>${{ number_format($total, 2) }}</td>
                            <td>100%</td>
                            <td>{{ $countsByType->sum('retraso') }}</td>
                            <td>{{ $countsByType->sum('perdida') }}</td>
                            <td>{{ $countsByType->sum('danio') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
    

    <!-- 

    <div class="container mt-3">
        <canvas id="chart" width="10" height="4"></canvas>
    </div>
    
    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    label: 'Monto por Mes',
                    data: {!! json_encode($chartData['values']) !!},
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Montos por Mes'
                    }
                }
            }
        });
        </script>
    -->
</body>
</html>
