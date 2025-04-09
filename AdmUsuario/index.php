<?php 
include './controlador/controlador.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AdmUsuario</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<aside>
    <p><strong>Bienvenido:</strong> <?= $_SESSION['usuario'] ?></p>
    <p><strong>Perfil:</strong> <?= $_SESSION['perfil'] ?? 'No definido' ?></p>
    <?php foreach ($modulos as $modulo): ?>
        <a href="<?= '/SEyBT'.$modulo['url'] ?>"><?= $modulo['nombre'] ?></a>
    <?php endforeach; ?>
    <a href="../logout.php" style="color:red;">Cerrar sesión</a>
</aside>
<main>
    <h2>Usuarios Registrados</h2>
    <!-- Botón de agregar usuario -->
    <form action="agregar.php" method="post">
        <input type="submit" value="Agregar Usuario">
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Nick</th>
            <th>Edad</th>
            <th>Contraseña</th>
            <th>Perfil</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $row): ?>
        <tr>
            <td><?= $row['Id_u'] ?></td>
            <td><?= $row['Nombre'] ?></td>
            <td><?= $row['Nick'] ?></td>
            <td><?= $row['Edad'] ?></td>
            <td><?= $row['Pwd'] ?></td>
            <td><?= $row['Perfil'] ?></td>
            <td>
                <form action="./controlador/activar_controlador.php" method="post">
                    <input type="hidden" name="id_u" value="<?= $row['Id_u'] ?>">
                    <input type="submit" value="<?= isset($row['Borrado']) && $row['Borrado'] == 1 ? 'Activar' : 'Desactivar' ?>">
                </form>
            </td>
            <td>
                <form action="editar.php" method="post">
                    <input type="hidden" name="id_u" value="<?= $row['Id_u'] ?>">
                    <input type="submit" value="Editar">
                </form>
            </td> 
        </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>