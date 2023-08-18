<?php
function registrarRol($nombre)
{
    $conexion = connectToDatabase();
    if (!$conexion) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }
    // Escapar el valor del lugar para evitar inyección de SQL
    $nombre = mysqli_real_escape_string($conexion, $nombre);
    $consulta = "INSERT INTO rol (nombre) VALUES ('$nombre')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $consulta)) {
        echo "Rol registrado correctamente.";
    } else {
        echo "Error al registrar el Rol: " . mysqli_error($conexion);
    }
    header('Location: ../rol.php');
    // Cerrar la conexión a la base de datos
    $conexion->close();
}


function obtenerRol()
{
    $conexion = connectToDatabase();
    if ($conexion) {
        $query = "SELECT * FROM rol";
        $result = $conexion->query($query);
        if ($result && $result->num_rows > 0) {
            $rol = array();
            while ($row = $result->fetch_assoc()) {
                $rol[] = $row;
            }
            $conexion->close();
            return $rol;
        }
        $conexion->close();
    }
    return false;
}
