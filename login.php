<?php
// Conexión a la base de datos
$connection = mysqli_connect("localhost", "root", "", "puntodevista");

if (!$connection) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta para verificar las credenciales del usuario
$sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "Inicio de sesión exitoso";
} else {
    echo "Nombre de usuario o contraseña incorrectos";
}

// Cerrar conexión
mysqli_close($connection);
?>
