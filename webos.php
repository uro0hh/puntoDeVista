
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>consulta db</title>
    <style type="text/css">
     
      table {
        border: solid 2px #7e7c7c;
        border-collapse: collapse;
                     
      }
     
      th, h1 {
        background-color: #edf797;
      }

      td,
      th {
        border: solid 1px #7e7c7c;
        padding: 2px;
        text-align: center;
      }


    </style>
</head>
<body>
    
</body>
</html>


<?php

$user = "root";
$pass = "";
$host = "localhost";
$db = "puntodevista";


$connection = mysqli_connect($host, $user, $pass, $db);



$nombre = $_POST["nombre"] ;
$apellido = $_POST["apellido"] ;
$carrera = $_POST["carrera"] ;


if(!$connection) 
        {
            echo "No se ha podido conectar con el servidor" . mysql_error();
        }
  else
        {
            echo "<b><h3>Hemos conectado al servidor</h3></b>" ;
        }
        
        $datab = "formulario";
       
        $db = mysqli_select_db($connection,$datab);

        if (!$db)
        {
        echo "No se ha podido encontrar la Tabla";
        }
        else
        {
        echo "<h3>Tabla seleccionada:</h3>" ;
        }
        
        $instruccion_SQL = "INSERT INTO formulario (nombre, apellido, carrera)
                             VALUES ('$nombre','$apellido','$carrera')";
                           
                            
        $resultado = mysqli_query($connection,$instruccion_SQL);

        
        $consulta = "SELECT * FROM formulario";
        
        $result = mysqli_query($connection, $consulta);

        if (!$result) {
            echo "No se ha podido realizar la consulta: " . mysqli_error($connection);
            exit; // Detener la ejecución si hay un error
        }
        
        echo "<table>";
        echo "<tr>";
        echo "<th>Id</th>";
        echo "<th>Nombre</th>";
        echo "<th>Usuario</th>";
        echo "<th>Carrera</th>";
        echo "</tr>";
        
        while ($colum = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($colum['id']) . "</td>";
            echo "<td>" . htmlspecialchars($colum['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($colum['apellido']) . "</td>";
            echo "<td>" . htmlspecialchars($colum['carrera']) . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
echo "</table>";

mysqli_close( $connection );

   //echo "Fuera " ;
   echo'<a href="index.html"> Volver Atrás</a>';


?>