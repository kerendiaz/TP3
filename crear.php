<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Nueva Obra</title>
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
            background-color: #d3d3c4; 
            border: none;
            border-radius: 5px;
            color: #5a5a5a; 
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #c2b29b; 
        }
    </style>
</head>
<body>
    <h2>Agregar Nueva Obra de Arte</h2>
    <form action="insertar.php" method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required>

        <label for="artista">Artista:</label>
        <input type="text" name="artista" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"></textarea>

        <label for="anio">Año:</label>
        <input type="number" name="anio">

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" accept="image/*">

        <input type="submit" value="Agregar">
    </form>
</body>
</html>
