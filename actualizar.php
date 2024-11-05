<?php
$conexion = new mysqli("keren.alwaysdata.net", "keren","registro2024", "keren_yoa");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$artista = $_POST['artista'];
$descripcion = $_POST['descripcion'];
$anio = $_POST['anio'];
$imagenRuta = $_POST['imagen_actual'];

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $directorio = "imagenes/";
    if (!file_exists($directorio)) {
        mkdir($directorio, 0777, true);
    }
    $nombreArchivo = basename($_FILES["imagen"]["name"]);
    $imagenRuta = $directorio . $nombreArchivo;
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagenRuta);
}

$sql = "UPDATE obras SET titulo='$titulo', artista='$artista', descripcion='$descripcion', anio='$anio', imagen='$imagenRuta' WHERE id=$id";

if ($conexion->query($sql) === TRUE) {
    echo "Obra de arte actualizada con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>