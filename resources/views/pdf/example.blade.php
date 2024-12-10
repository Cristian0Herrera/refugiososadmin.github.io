<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refugiados</title>
    <!-- Importar la fuente Poppins desde Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,
    300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;
    1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Uso de la fuente Poppins */
            margin: 0;
            padding: 0;
            font-size: 14px; /* Tamaño de fuente global */
        }

        .header {
            display: flex;
            align-items: center;
            padding: 10px;
        }

        .header img {
            margin-right: 10px;
        }

        .header h1 {
            font-size: 24px; /* Tamaño de fuente para el título */
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: 'Poppins', sans-serif;

        }

        th, td {
            border: 0.5px solid #000;
            padding: 8px;
            text-align: left;
            font-size: 11px; /* Tamaño de fuente para celdas */
            font-family: 'Poppins', sans-serif;
            vertical-align: middle; /* Alinea verticalmente al centro */
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */

        }

        th {
            background-color: #cbe2ff;
            color: rgb(0, 0, 0);
            font-size: 13px; /* Tamaño de fuente para las cabeceras */
            font-style: normal;
        }

        td {
            background-color: #f9f9f9;
            font-weight: 400; /* Peso normal para el contenido */
        }

            .footer {
        position: absolute;
        bottom: 10px; /* Ajusta según sea necesario */
        right: 10px;  /* Ajusta según sea necesario */
        font-size: 12px;
        color: #000;
        
    }




        @media print {
            body {
                background-color: white; /* Fondo blanco para impresión */
            }

            .header {
                background-color: white; /* Sin fondo en impresión */
            }

            table {
                background-color: white; /* Fondo blanco para tabla */
            }

            th {
                background-color: #85b5f3;
                color: white;
            }

            td {
                background-color: white; /* Fondo blanco para celdas */
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="images/LOGO.png" alt="Logo" width="100" height="100">
        <h1>Registros de todos los refugiados</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>Fecha de nacimiento</th>
                <th>Teléfono</th>
                <th>Género</th>
                <th>DUI</th>
                <th>Fecha de ingreso</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($refugiados as $item)
            <tr>
                <td>{{ $item->nombre }}</td>
                <td>{{ $item->fechaNacimiento }}</td>
                <td>{{ $item->telefono }}</td>
                <td>{{ $item->genero }}</td>
                <td>{{ $item->dui }}</td>
                <td>{{ $item->fechaIngreso }}</td>
                <td>{{ $item->observaciones }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <span class="date-time">{{ now()->format('d-m-Y H:i:s') }}</span>
    </div>

    
</body>
</html>