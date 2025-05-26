<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "nombre_de_tu_bd");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener las publicaciones
$sql = "SELECT id, titulo, contenido, autor, fecha FROM publicaciones ORDER BY fecha DESC";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Foro - Publicaciones</title>
    <style>
        body {
            background: #dae0e6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #fff;
            border-bottom: 1px solid #ccc;
            padding: 16px 0;
            text-align: center;
            font-size: 2em;
            font-weight: bold;
            color:rgb(87, 106, 255);
            letter-spacing: 2px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.03);
        }
        .container {
            max-width: 700px;
            margin: 30px auto;
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 24px 32px;
        }
        .publicacion {
            display: flex;
            border-bottom: 1px solid #eee;
            padding: 18px 0;
        }
        .votos {
            width: 48px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 18px;
            color: #878a8c;
            font-size: 1.2em;
        }
        .votos .arrow {
            font-size: 1.5em;
            cursor: pointer;
            user-select: none;
        }
        .contenido-publicacion {
            flex: 1;
        }
        .titulo {
            font-size: 1.25em;
            font-weight: bold;
            color: #222;
            margin-bottom: 6px;
        }
        .meta {
            color: #878a8c;
            font-size: 0.95em;
            margin-bottom: 10px;
        }
        .contenido {
            color: #333;
            margin-bottom: 8px;
        }
        .publicacion:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="header">RedditGTP - Foro</div>
    <div class="container">
        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <?php while($fila = $resultado->fetch_assoc()): ?>
                <div class="publicacion">
                    <div class="votos">
                        <div class="arrow">&#9650;</div>
                        <div>0</div>
                        <div class="arrow">&#9660;</div>
                    </div>
                    <div class="contenido-publicacion">
                        <div class="titulo"><?= htmlspecialchars($fila['titulo']) ?></div>
                        <div class="meta">Publicado por <?= htmlspecialchars($fila['autor']) ?> | <?= htmlspecialchars($fila['fecha']) ?></div>
                        <div class="contenido"><?= nl2br(htmlspecialchars($fila['contenido'])) ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay publicaciones aún.</p>
        <?php endif; ?>
        <?php $conexion->close(); ?>
    </div>
</body>
</html>