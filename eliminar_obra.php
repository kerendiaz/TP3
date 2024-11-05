<?php
$conexion = new mysqli("keren.alwaysdata.net", "keren","registro2024", "keren_yoa");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id = $_GET['id'];

// Primero, obtenemos la ruta de la imagen para eliminar el archivo
$sql = "SELECT imagen FROM obras WHERE id=$id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $imagenRuta = $fila['imagen'];

    // Eliminamos el archivo de imagen si existe
    if (file_exists($imagenRuta)) {
        unlink($imagenRuta);
    }
}

// Luego, eliminamos el registro de la base de datos
$sql = "DELETE FROM obras WHERE id=$id";

if ($conexion->query($sql) === TRUE) {
    echo "Obra de arte eliminada con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>