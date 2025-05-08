<?php 
include './controlador/controlador.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AdmBitacora</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<aside>
    <div class="bienvenida">
        <p><strong>Bienvenido:</strong> <?= $_SESSION['usuario'] ?></p>
        <p><strong>Perfil:</strong> <?= $_SESSION['perfil'] ?? 'No definido' ?></p>
    </div>
    <?php foreach ($modulos as $modulo): ?>
        <a href="<?= '/SEyBT'.$modulo['url'] ?>"><?= $modulo['nombre'] ?></a>
    <?php endforeach; ?>
    <a href="../logout.php" style="color:red;">Cerrar sesión</a>
</aside>
<main>
    <h2>Bitácora</h2>
    <form method="GET">
        <input type="text" name="buscar" placeholder="Buscar usuario..." value="<?= htmlspecialchars($buscar) ?>">
        <button type="submit">Buscar</button>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Acción</th>
            <th>Usuario</th>
            <th>Nick</th>
        </tr>
        <?php foreach ($registros as $row): ?>
        <tr>
            <td><?= $row['Id_b'] ?></td>
            <td><?= $row['fecha'] ?></td>
            <td><?= $row['hora'] ?></td>
            <td><?= $row['accion'] ?></td>
            <td><?= $row['Nombre'] ?></td>
            <td><?= $row['Nick'] ?></td>
            <td>
                <form action="eliminar.php" method="POST" style="margin: 0;">
                    <input type="hidden" name="id_b" value="<?= $row['Id_b'] ?>">
                    <button type="submit" style="color: red; border: none; background: none; cursor: pointer;">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>