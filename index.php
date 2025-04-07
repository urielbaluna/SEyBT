<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<aside>
    <p><strong>Bienvenido:</strong> <?= $_SESSION['usuario'] ?></p>
    <a href="AdmUsuario/index.php">AdmUsuario</a>
    <a href="AdmModulo/index.php">AdmModulo</a>
    <a href="AdmBitacora/index.php">AdmBitacora</a>
    <a href="logout.php" style="color:red;">Cerrar sesión</a>
</aside>
<main>
    <h2>Panel Principal</h2>
    <p>Selecciona una opción del menú para continuar.</p>
</main>
</body>
</html>
