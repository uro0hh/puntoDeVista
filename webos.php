<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta DB</title>
    <style type="text/css">
        /* Fondo con 70% amarillo y 30% negro */
        body {
            background: linear-gradient(to top, #FFB800 70%, black 30%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Contenedor del formulario */
        .container {
            width: 500px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }

        
        input[type="text"],
        input[type="date"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        h2, h3 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: solid 1px #7e7c7c;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #edf797;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
            padding: 10px;
            background-color: #edf797;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #d4d100;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Consulta de Base de Datos</h2>

    <?php
    $user = "root";
    $pass = "";
    $host = "localhost";
    $db = "puntodevista";

    $connection = mysqli_connect($host, $user, $pass, $db);

    if (!$connection) {
        echo "<b><h3>No se ha podido conectar con el servidor</h3></b>";
        exit;
    } else {
        echo "<b><h3>Hemos conectado al servidor</h3></b>";
    }

    // Verificar si se han recibido datos del formulario para insertar
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir datos del formulario
        $nombre = $_POST["nombre"] ?? '';
        $apellido = $_POST["apellido"] ?? '';
        $carrera = $_POST["carrera"] ?? '';
        $objeto = $_POST["objeto"] ?? '';

        // Inserción en la base de datos
        $instruccion_SQL = "INSERT INTO formulario2 (nombre, apellido, carrera, objeto) VALUES ('$nombre','$apellido','$carrera','$objeto')";
        $resultado = mysqli_query($connection, $instruccion_SQL);
        
        if ($resultado) {
            echo "<p>Datos insertados correctamente.</p>";
        } else {
            echo "<p>Error al insertar los datos: " . mysqli_error($connection) . "</p>";
        }
    }

    // Consulta para mostrar los datos
    $consulta = "SELECT * FROM formulario2";
    $result = mysqli_query($connection, $consulta);

    if (!$result) {
        echo "No se ha podido realizar la consulta: " . mysqli_error($connection);
        exit; // Detener la ejecución si hay un error
    }

    echo "<table>";
    echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Apellido</th>";
    echo "<th>Carrera</th>";
    echo "<th>Objeto</th>";
    echo "</tr>";

    while ($colum = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($colum['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($colum['apellido']) . "</td>";
        echo "<td>" . htmlspecialchars($colum['carrera']) . "</td>";
        echo "<td>" . htmlspecialchars($colum['objeto']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    mysqli_close($connection);
    ?>

    <a href="historial.html">Volver Atrás</a>
</div>

</body>
</html>
