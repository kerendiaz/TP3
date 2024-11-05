<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Galería de Arte</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc; 
            color: #5a5a5a; 
            margin: 0;
            padding: 0;
        }
        nav {
            margin-bottom: 20px;
            background-color: #d3d3c4; 
            padding: 10px;
            text-align: center;
        }
        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #5a5a5a; 
            font-weight: bold;
        }
        nav a:hover {
            color: #8b4513; 
        }
        h1 {
            color: #8b4513; 
            text-align: center;
        }
        p {
            text-align: center; 
            font-size: 18px;
        }
        .inspirational {
            text-align: center;
            color: #8b4513; 
            font-style: italic;
            margin-top: 10px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px;
            background-color: #d3d3c4; 
            border: none;
            border-radius: 5px;
            color: #5a5a5a;
            text-decoration: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #c2b29b; 
        }
    </style>
</head>
<body>
    <h1>Bienvenido a la Galería de Arte</h1>
    <nav>
        <a href="listar.php" class="btn">Ver Obras</a>
        <a href="crear.php" class="btn">Agregar Nueva Obra</a>
    </nav>
    <p>Disfruta de nuestra colección de obras de arte.</p>
    <p class="inspirational">"El arte no reproduce lo visible, sino que hace visible lo invisible." - Paul Klee</p>
</body>
</html>
