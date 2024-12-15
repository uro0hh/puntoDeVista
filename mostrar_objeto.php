<?php
// Conexión a la base de datos
$connection = mysqli_connect("localhost", "root", "", "puntodevista");

if (!$connection) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta para obtener todos los objetos perdidos
$sql = "SELECT objeto.idObjeto, categoria_objeto.nombreCategoria_objeto, objeto.descripcionObjeto, objeto.fechaIngresoObjeto, objeto.salonObjeto, objeto.imagenObjeto, estado_objeto.nombreEstado_objeto 
        FROM objeto 
        JOIN categoria_objeto ON objeto.categoria_objeto_idCategoria_objeto = categoria_objeto.idCategoria_objeto
        JOIN estado_objeto ON objeto.estado_objeto_idEstado_objeto = estado_objeto.idEstado_objeto";

$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Objetos Perdidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Lista de Objetos Perdidos</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Categoría</th>
            <th>Descripción</th>
            <th>Fecha de Ingreso</th>
            <th>Sala</th>
            <th>Imagen</th>
            <th>Estado</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['idObjeto'] . "</td>";
                echo "<td>" . htmlspecialchars($row['nombreCategoria_objeto']) . "</td>";
                echo "<td>" . htmlspecialchars($row['descripcionObjeto']) . "</td>";
                echo "<td>" . htmlspecialchars($row['fechaIngresoObjeto']) . "</td>";
                echo "<td>" . htmlspecialchars($row['salonObjeto']) . "</td>";
                echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['imagenObjeto']) . "' alt='Imagen del objeto' style='width:100px;height:auto;'></td>";
                echo "<td>" . htmlspecialchars($row['nombreEstado_objeto']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No se encontraron objetos perdidos.</td></tr>";
        }
        ?>
    </table>
    <a href="index.html" style="display: block; margin-top: 20px; text-decoration: none; text-align: center;">
          <button type="button">Volver al Menu</button>
      </a>
</body>
</html>

<?php
mysqli_close($connection);
?>
