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
    $tipo_objeto = $_POST['tipo_objeto'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $sala_encontrado = $_POST['sala_encontrado'];
    $hora_encontrado = $_POST['hora_encontrado'];
    $id_objeto = $_POST['id_objeto'];
    $ingresado_por = $_POST['ingresado_por'];
    $descripcion = $_POST['descripcion'];

    // Procesar la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombre_imagen = $_FILES['imagen']['name'];
        $ruta_temporal = $_FILES['imagen']['tmp_name'];
        $carpeta_destino = "imagenes/";

        if (!file_exists($carpeta_destino)) {
            mkdir($carpeta_destino, 0777, true);
        }

        $ruta_imagen = $carpeta_destino . $nombre_imagen;

        if (move_uploaded_file($ruta_temporal, $ruta_imagen)) {
            // Inserción en la base de datos
            $sql = "INSERT INTO objetos (nombre_objeto, tipo_objeto, fecha_ingreso, sala_encontrado, hora_encontrado, id_objeto, ingresado_por, descripcion, ruta_imagen) 
                    VALUES ('$nombre_objeto', '$tipo_objeto', '$fecha_ingreso', '$sala_encontrado', '$hora_encontrado', '$id_objeto', '$ingresado_por', '$descripcion', '$ruta_imagen')";

            if (mysqli_query($connection, $sql)) {
                echo "Objeto ingresado correctamente.";
            } else {
                echo "Error al ingresar el objeto: " . mysqli_error($connection);
            }
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "No se ha seleccionado ninguna imagen o ha ocurrido un error al subirla.";
    }
}

mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Punto De Vista - Ingreso de Objetos</title>
  <link rel="stylesheet" href="./style.css">
</head>
<body>

<div class="container">  
<form id="contact" action="" method="post" enctype="multipart/form-data">
    <h2>Punto De Vista</h2>
    <h3>Formulario de Ingreso de Objetos</h3>
    
    <fieldset>
      <input name="nombre_objeto" placeholder="Nombre Objeto" type="text" required autofocus>
    </fieldset>
    
    <fieldset>
      <input name="tipo_objeto" placeholder="Tipo de Objeto" type="text" required>
    </fieldset>
    
    <fieldset>
    <input placeholder="Fecha de ingreso" type="date" name="fecha_ingreso" tabindex="3" required>
</fieldset>

    
    <fieldset>
      <input name="sala_encontrado" placeholder="Sala donde se encontró" type="text" required>
    </fieldset>
    
    <fieldset>
      <input name="hora_encontrado" placeholder="Hora en la que se encontró" type="text" required>
    </fieldset>
    
    <fieldset>
      <input name="id_objeto" placeholder="ID Objeto" type="text" required>
    </fieldset>
    
    <fieldset>
      <input name="ingresado_por" placeholder="Ingresado por" type="text" required>
    </fieldset>
    
    <fieldset>
      <textarea name="descripcion" placeholder="Descripción" required></textarea>
    </fieldset>

    <fieldset>
        <input type="file" name="imagen" accept="image/*" required>
    </fieldset>
    
    <fieldset>
      <button name="submit" type="submit" id="contact-submit">Ingresar Objeto</button>
    </fieldset>
  </form>
</div>

</body>
</html>
