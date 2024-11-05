

<?php
// Conexión a la base de datos
$conexion = new mysqli("keren.alwaysdata.net", "keren","registro2024", "keren_yoa");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificamos si se ha enviado un ID y es un número
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Obtener la obra de arte por ID
    $sql = "SELECT * FROM obras WHERE id=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $obra = $resultado->fetch_assoc();
    } else {
        echo "No se encontró la obra con el ID proporcionado.";
        exit;
    }

    // Manejo de la actualización del formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = $_POST['titulo'];
        $artista = $_POST['artista'];
        $descripcion = $_POST['descripcion'];
        $anio = $_POST['anio'];

        // Verificamos si se subió una nueva imagen
        if (!empty($_FILES['imagen']['name'])) {
            $imagenRuta = 'ruta/donde/guardar/la/imagen/' . basename($_FILES['imagen']['name']);
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenRuta)) {
                // Actualizamos la obra con la nueva imagen
                $sql = "UPDATE obras SET titulo=?, artista=?, descripcion=?, anio=?, imagen=? WHERE id=?";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("ssssii", $titulo, $artista, $descripcion, $anio, $imagenRuta, $id);
            } else {
                echo "Error al subir la imagen.";
            }
        } else {
            // Si no se subió una nueva imagen, mantenemos la imagen existente
            $sql = "UPDATE obras SET titulo=?, artista=?, descripcion=?, anio=? WHERE id=?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssssi", $titulo, $artista, $descripcion, $anio, $id);
        }

        // Ejecutamos la actualización
        if ($stmt->execute()) {
            echo "Obra de arte actualizada con éxito.";
        } else {
            echo "Error al actualizar: " . $stmt->error;
        }
    }
} else {
    echo "ID inválido.";
    exit;
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Obra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc; /* Fondo color crema */
            color: #5a5a5a; /* Color del texto */
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #8b4513; /* Color marrón */
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #d3d3c4; /* Botón color crema */
            border: none;
            border-radius: 5px;
            color: #5a5a5a; /* Color del texto del botón */
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #c2b29b; /* Hover ligeramente más oscuro */
        }
        img {
            display: block;
            margin: 10px auto;
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        p {
            text-align: center;
            color: #5a5a5a;
        }
    </style>
</head>
<body>
    <h2>Editar Obra de Arte</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="<?php echo htmlspecialchars($obra['titulo']); ?>" required>

        <label for="artista">Artista:</label>
        <input type="text" name="artista" value="<?php echo htmlspecialchars($obra['artista']); ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?php echo htmlspecialchars($obra['descripcion']); ?></textarea>

        <label for="anio">Año:</label>
        <input type="number" name="anio" value="<?php echo htmlspecialchars($obra['anio']); ?>">

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" accept="image/*">
        <p>Imagen actual:</p>
        <img src="<?php echo htmlspecialchars($obra['imagen']); ?>" alt="Imagen de la obra">
        <p>Si no deseas cambiar la imagen, simplemente deja el campo vacío.</p>

        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
