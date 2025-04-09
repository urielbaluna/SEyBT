<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
include_once './config/conexion.php'; // Asegúrate de incluir la conexión a la base de datos

// Obtener el perfil del usuario
$perfil = $_SESSION['perfil'];

// Consulta para obtener los módulos habilitados para el perfil
$sql = "SELECT modulo.nombre, modulo.url 
        FROM modulo 
        INNER JOIN mod_perfil ON mod_perfil.Id_mod = modulo.Id_mod 
        WHERE mod_perfil.Id_p = (SELECT Id_p FROM perfil WHERE Nombre = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $perfil);
$stmt->execute();
$result = $stmt->get_result();

// Almacenar los módulos en un array
$modulos = [];
while ($row = $result->fetch_assoc()) {
    $modulos[] = $row;
}
$stmt->close();
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
<!-- SELECT modulo.nombre, modulo.url FROM modulo INNER JOIN mod_perfil ON mod_perfil.Id_mod=modulo.Id_mod WHERE id_p = (SELECT id_p FROM perfil WHERE Nombre="Estudiante"); -->
    <p><strong>Bienvenido:</strong> <?= $_SESSION['usuario'] ?></p>
    <p><strong>Perfil:</strong> <?= $_SESSION['perfil'] ?></p>
    <?php foreach ($modulos as $modulo): ?>
        <a href="<?= '/SEyBT'.$modulo['url'] ?>"><?= $modulo['nombre'] ?></a>
    <?php endforeach; ?>
    <a href="./logout.php" style="color:red;">Cerrar sesión</a>
</aside>
<main>
    <h2>Panel Principal</h2>
    <p>Selecciona una opción del menú para continuar.</p>
</main>
</body>
</html>
