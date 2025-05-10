<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gestión de Usuarios</h1>

    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required
               value="<?= $editar_usuario ? htmlspecialchars($editar_usuario['nombre']) : '' ?>">
        <input type="email" name="correo" placeholder="Correo Electrónico" required
               value="<?= $editar_usuario ? htmlspecialchars($editar_usuario['correo']) : '' ?>">
        <?php if ($editar_usuario): ?>
            <input type="hidden" name="editar_id" value="<?= $editar_usuario['id'] ?>">
            <button type="submit">Actualizar Usuario</button>
            <a href="index.php">Cancelar</a>
        <?php else: ?>
            <button type="submit">Agregar Usuario</button>
        <?php endif; ?>
    </form>

    <h2>Lista de Usuarios</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $usuarios->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['nombre']) ?></td>
            <td><?= htmlspecialchars($row['correo']) ?></td>
            <td>
                <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
                <a href="?eliminar=<?= $row['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
