<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'puntodevista'); // Cambia 'root' y '' según tus credenciales

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el ID del objeto a eliminar
$objeto_id = $_POST['objeto_id'];

// Preparar la consulta para eliminar el objeto
$sql = "DELETE FROM objetos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $objeto_id);

if ($stmt->execute()) {
    echo "Objeto eliminado con éxito.";
} else {
    echo "Error al eliminar el objeto: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
