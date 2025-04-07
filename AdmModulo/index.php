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
    <title>AdmModulo</title>
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
    <h2>Módulos Registrados</h2>
    <table>
        <tr>
            <th>Perfil</th>
            <th>Modulos</th>
            <th>Borrado</th>
        </tr>
        <?php while ($row = $modulos->fetch_assoc()): ?>
        <tr>
            <td><?= $row['Perfil'] ?></td>
            <td><?= $row['Modulos'] ?></td>
            <td>
                <form action="activar.php" method="post">
                    <input type="hidden" name="id_m" value="?= $row['Id_m'] ?">
                    <input type="submit" value="<?= isset($row['Borrado']) && $row['Borrado'] == 0 ? 'Desactivar' : 'Activar' ?>">
                </form>
            </td>
        </tr>
        
        <?php endwhile; ?>
    </table>
</main>
</body>
</html>
