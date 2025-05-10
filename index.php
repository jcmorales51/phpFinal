<?php
$conexion = new mysqli('localhost', 'root', '', 'gestion_usuarios');

// Agregar usuario nuevo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['editar_id'])) {
        // Actualizar usuario existente
        $id = $_POST['editar_id'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $conexion->query("UPDATE usuarios SET nombre='$nombre', correo='$correo' WHERE id=$id");
    } else {
        // Insertar nuevo usuario
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $conexion->query("INSERT INTO usuarios (nombre, correo) VALUES ('$nombre', '$correo')");
    }
    header('Location: index.php');
}

// Eliminar usuario
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM usuarios WHERE id = $id");
    header('Location: index.php');
}

// Obtener usuario a editar (si existe)
$editar_usuario = null;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $resultado = $conexion->query("SELECT * FROM usuarios WHERE id = $id");
    if ($resultado->num_rows > 0) {
        $editar_usuario = $resultado->fetch_assoc();
    }
}

// Obtener todos los usuarios
$usuarios = $conexion->query("SELECT * FROM usuarios ORDER BY id");

include 'index.view.php';
?>
