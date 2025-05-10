<?php
$conexion = new mysqli('localhost', 'root', '', 'gestion_usuarios');

// Obtener datos del usuario
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$resultado = $conexion->query("SELECT * FROM usuarios WHERE id = $id");

if ($resultado->num_rows === 0) {
    echo "Usuario no encontrado.";
    exit;
}

$usuario = $resultado->fetch_assoc();

// Procesar actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $conexion->query("UPDATE usuarios SET nombre='$nombre', correo='$correo' WHERE id=$id");
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Usuario</h1>

    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required value="<?= htmlspecialchars($usuario['nombre']) ?>">
        <input type="email" name="correo" placeholder="Correo Electrónico" required value="<?= htmlspecialchars($usuario['correo']) ?>">
        <button type="submit">Guardar Cambios</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
