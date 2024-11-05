<?php
$conexion = new mysqli("keren.alwaysdata.net", "keren","registro2024", "keren_yoa");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $artista = $_POST['artista'];
    $descripcion = $_POST['descripcion'];
    $anio = $_POST['anio'];
    $imagenRuta = '';

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $directorio = "imagenes/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        $nombreArchivo = basename($_FILES["imagen"]["name"]);
        $imagenRuta = $directorio . $nombreArchivo;
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagenRuta);
    }

    $sql = "INSERT INTO obras (titulo, artista, descripcion, anio, imagen) VALUES ('$titulo', '$artista', '$descripcion', '$anio', '$imagenRuta')";

    if ($conexion->query($sql) === TRUE) {
        echo "<p>Obra de arte agregada con éxito</p>";
        echo '<a href="listar.php">Volver a la lista de obras</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Obra de Arte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc;
            color: #5a5a5a;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #8b4513;
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="file"] {
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: #8b4513;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #a0522d;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Agregar Obra de Arte</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required>

        <label for="artista">Artista:</label>
        <input type="text" name="artista" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea>

        <label for="anio">Año:</label>
        <input type="number" name="anio" required>

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" accept="image/*">

        <input type="submit" value="Agregar">
    </form>
    <a class="back-link" href="listar.php">Volver a la lista de obras</a>
</body>
</html>
