<?php
$conn = mysqli_connect("localhost", "root", "", "puntodevista");

// Verificamos la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtenemos el ID del registro
$registro_id = $_POST['registro_id'];

// Validamos que el ID del registro no esté vacío
if (empty($registro_id)) {
    die("ID del registro es requerido");
}

// Preparamos la consulta SQL para evitar inyecciones SQL
$sql = "DELETE FROM formulario WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // Asignamos el ID a la declaración preparada
    mysqli_stmt_bind_param($stmt, "i", $registro_id);

    // Ejecutamos la consulta
    if (mysqli_stmt_execute($stmt)) {
        echo "Registro eliminado exitosamente";
    } else {
        echo "Error al eliminar el registro: " . mysqli_stmt_error($stmt);
    }

    // Cerramos la declaración
    mysqli_stmt_close($stmt);
} else {
    echo "Error en la preparación de la consulta: " . mysqli_error($conn);
}

// Cerramos la conexión
mysqli_close($conn);
?>
