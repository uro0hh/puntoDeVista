<?php
$conn=mysqli_connect("localhost" , "root" ,"" , "puntodevista");

if(!$conn) {
  die("Parece que la página no está funcionando correctamente");
}

$producto_id = $_POST['producto_id'];

if (empty($producto_id)) {
  die("ID del producto es requerido");
}

$sql = "DELETE FROM productos WHERE id = '$producto_id'";

if (mysqli_query($conn, $sql)) {
  echo "Producto eliminado exitosamente";
} else {
  echo "Error al eliminar el producto: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
