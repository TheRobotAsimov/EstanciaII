<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #000; }
    </style>
</head>
<body>
    <h1>Tabla de Movimientos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Subtipo</th>
                <th>Empleado</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movimientos as $movimiento)
                <tr>
                    <td>{{ $movimiento->id }}</td>
                    <td>{{ $movimiento->subtipo->tipo->nombre }}</td>
                    <td>{{ $movimiento->subtipo->nombre }}</td>
                    <td>{{ $movimiento->empleado->usuario->nombre}}</td>
                    <td>{{ $movimiento->monto }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
