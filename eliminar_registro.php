<?php
$conn=mysqli_connect("localhost" , "root" ,"" , "puntodevista");

if(!$conn) {
  die("Parece que la página no está funcionando correctamente");
}

$registro_id = $_POST['registro_id'];

if (empty($registro_id)) {
  die("ID del registro es requerido");
}

$sql = "DELETE FROM formulario WHERE id = '$registro_id'";

if (mysqli_query($conn, $sql)) {
  echo "Registro eliminado exitosamente";
} else {
  echo "Error al eliminar el registro: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
