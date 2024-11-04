<?php
// Conexión a la base de datos
$conn = mysqli_connect("localhost", "root", "", "puntodevista");

if (!$conn) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Obtener los datos del formulario
$rut = $_POST['rut'];
$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$correo_electronico = $_POST['correo_electronico'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Encriptación de la contraseña
$telefono = $_POST['telefono'];
$tipo_usuario = $_POST['tipo_usuario'];

// Validación de datos requeridos
if (empty($rut) || empty($nombre) || empty($apellido_paterno) || empty($correo_electronico) || empty($contrasena) || empty($tipo_usuario)) {
    die("Por favor, complete todos los campos obligatorios.");
}

// Insertar datos en la tabla Usuarios
$sql = "INSERT INTO Usuarios (RUT, Nombre, Apellido_Paterno, Apellido_Materno, Correo_Electronico, Contraseña, Telefono, Tipo_Usuario) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssss", $rut, $nombre, $apellido_paterno, $apellido_materno, $correo_electronico, $contrasena, $telefono, $tipo_usuario);

if (mysqli_stmt_execute($stmt)) {
    echo "Usuario registrado exitosamente.";
} else {
    echo "Error al registrar el usuario: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
