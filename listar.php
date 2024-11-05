<?php
$conexion = new mysqli("keren.alwaysdata.net", "keren","registro2024", "keren_yoa");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT * FROM obras";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Obras de Arte</title>
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
        a {
            text-decoration: none;
            color: #8b4513;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #ffffff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #d3d3c4;
            color: #5a5a5a;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .actions a {
            margin: 0 5px;
        }
        .btn-back {
            display: block;
            width: 150px;
            margin: 20px auto; 
            padding: 10px;
            background-color: #8b4513;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-back:hover {
            background-color: #7a3b12;
        }
    </style>
</head>
<body>
    <h2>Obras de Arte</h2>
    <a href="crear.php">Agregar Nueva Obra</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Artista</th>
            <th>Descripción</th>
            <th>Año</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
        <?php while($fila = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['titulo']; ?></td>
            <td><?php echo $fila['artista']; ?></td>
            <td><?php echo $fila['descripcion']; ?></td>
            <td><?php echo $fila['anio']; ?></td>
            <td>
                <?php if($fila['imagen']): ?>
                    <img src="<?php echo htmlspecialchars($fila['imagen']); ?>" alt="Imagen de <?php echo htmlspecialchars($fila['titulo']); ?>">
                <?php else: ?>
                    No hay imagen
                <?php endif; ?>
            </td>
            <td class="actions">
                <a href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a> |
                <a href="eliminar_obra.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta obra?');">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    
    <a href="index.php" class="btn-back">Volver al Inicio</a> 

</body>
</html>

<?php $conexion->close(); ?>
