<?php
// Conexión a la base de datos
$connection = mysqli_connect("localhost", "root", "", "puntodevista");

if (!$connection) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta para obtener solo las imágenes de los objetos perdidos
$sql = "SELECT imagenObjeto FROM objeto";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>PuntoDeVista</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Navegación -->
    <nav class="nav">
        <div class="nav__container">   
            <h1 class="nav__title">PuntoDeVista</h1>    
            <a href="#menu" class="nav__menu">
                <i class="fa-solid fa-bars"></i>
            </a>
            <a href="#" class="nav__menu nav__menu--second">
                <i class="fa-solid fa-x"></i>
            </a>
            <ul class="dropdown" id="menu">   
                <li class="dropdown__list">
                    <a href="#" class="dropdown__link">
                        <i class="fa-solid fa-house"></i>
                        <span class="dropdown__span">Inicio</span>
                    </a>
                </li>    
                <li class="dropdown__list">
                    <a href="historial.html" class="dropdown__link">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <span class="dropdown__span">Historial</span>    
                    </a>    
                </li>
                <li class="dropdown__list">
                    <a href="./ingresar_objeto.html" class="dropdown__link">
                        <i class="fa-solid fa-share-from-square"></i>
                        <span class="dropdown__span">Ingreso de objetos</span>   
                    </a> 
                </li>
                <li class="dropdown__list">
                    <a href="eliminar-producto.html" class="dropdown__link">
                        <i class="fa-solid fa-trash"></i>
                        <span class="dropdown__span">Eliminación de producto</span>  
                    </a> 
                </li>
                <li class="dropdown__list">
                    <a href="registro-usuario.html" class="dropdown__link">
                        <i class="fa-solid fa-user"></i>
                        <span class="dropdown__span">Registro de usuario</span>    
                    </a> 
                </li>
                <li class="dropdown__list">
                    <a href="eliminar-registro.html" class="dropdown__link">
                        <i class="fa-solid fa-trash-can-arrow-up"></i>
                        <span class="dropdown__span">Eliminación de registro</span>  
                    </a> 
                </li>
            </ul>   
        </div>
    </nav>

    <!-- Galería de imágenes -->
    <div class="galeria">
        <h1>Objetos perdidos</h1>
        <div class="linea"></div>
        <div class="contenedor-imagenes">
            <?php
            // Mostrar las imágenes si hay resultados
            if ($result && mysqli_num_rows($result) > 0) {
                $hay_imagenes = false; // Variable de control para verificar si hay imágenes

                while ($row = mysqli_fetch_assoc($result)) {
                    if (!empty($row['imagenObjeto'])) { // Solo mostrar si la imagen no está vacía
                        $hay_imagenes = true;
                        echo "<div class='imagen'>";
                        echo "<img src='data:image/jpeg;base64," . base64_encode($row['imagenObjeto']) . "' alt='Imagen del objeto' style='width:200px;height:auto;'>";
                        echo "</div>";
                    }
                }

                // Mensaje si no se encontró ninguna imagen válida
                if (!$hay_imagenes) {
                    echo "<p>No hay imágenes de objetos perdidos disponibles.</p>";
                }
            } else {
                echo "<p>No hay imágenes de objetos perdidos disponibles.</p>";
            }
            // Cerrar conexión
            mysqli_close($connection);
            ?>
        </div>
    </div>
</body>
</html>
