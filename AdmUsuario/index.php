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
    <title>AdmUsuario</title>
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
    <h2>Usuarios Registrados</h2>
    <!-- boton de agregar usuario -->
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
        <?php while ($row = $usuarios->fetch_assoc()): ?>
        <tr>
            <td><?= $row['Id_u'] ?></td>
            <td><?= $row['Nombre'] ?></td>
            <td><?= $row['Nick'] ?></td>
            <td><?= $row['Edad'] ?></td>
            <td><?= $row['Pwd'] ?></td>
            <td><?= $row['Perfil'] ?></td>
            <td>
                <form action="activar.php" method="post">
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
        <?php endwhile; ?>
    </table>
</main>
</body>
</html>
