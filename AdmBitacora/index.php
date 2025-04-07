<?php 
include 'controlador.php'; 
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
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
    <p><strong>Bienvenido:</strong> <?= $_SESSION['usuario'] ?></p>
    <p><strong>Perfil:</strong> <?= $_SESSION['perfil'] ?? 'No definido' ?></p>
    <a href="../AdmUsuario/index.php">AdmUsuario</a>
    <a href="../AdmModulo/index.php">AdmModulo</a>
    <a href="../AdmBitacora/index.php">AdmBitacora</a>
    <a href="logout.php" style="color:red;">Cerrar sesión</a>
</aside>
<main>
    <h2>Bitácora</h2>
    <form method="GET">
        <input type="text" name="buscar" placeholder="Buscar usuario...">
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
        <?php while ($row = $registros->fetch_assoc()): ?>
        <tr>
            <td><?= $row['Id_b'] ?></td>
            <td><?= $row['fecha'] ?></td>
            <td><?= $row['hora'] ?></td>
            <td><?= $row['accion'] ?></td>
            <td><?= $row['Nombre'] ?></td>
            <td><?= $row['Nick'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</main>
</body>
</html>
