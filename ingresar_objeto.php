<?php
// Conexión a la base de datos
$connection = mysqli_connect("localhost", "root", "", "puntodevista");

if (!$connection) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    // Recibir datos del formulario
    $nombre_objeto = $_POST['nombre_objeto'];
    $categoria_objeto_id = $_POST['categoria_objeto'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $salon_objeto = $_POST['salon_objeto'];
    $descripcion_objeto = $_POST['descripcion_objeto'];
    $estado_objeto_id = $_POST['estado_objeto'];
    $imagen_objeto = file_get_contents($_FILES['imagen_objeto']['tmp_name']);

    // Insertar el objeto perdido en la base de datos
    $sql = "INSERT INTO objeto (categoria_objeto_idCategoria_objeto, descripcionObjeto, fechaIngresoObjeto, salonObjeto, imagenObjeto, estado_objeto_idEstado_objeto) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "issssi", $categoria_objeto_id, $descripcion_objeto, $fecha_ingreso, $salon_objeto, $imagen_objeto, $estado_objeto_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Objeto ingresado correctamente.";
        } else {
            echo "Error al ingresar el objeto.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la declaración.";
    }

    mysqli_close($connection);
}
?>
