<?php
session_start();
include 'config/conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nick = $_POST['nick'];
    $pwd = $_POST['pwd'];

    // Modificar la consulta para incluir el perfil del usuario
    $sql = "SELECT usuario.Id_u, usuario.Nombre, usuario.Nick, perfil.Nombre AS Perfil
            FROM usuario
            LEFT JOIN perfil ON usuario.Id_p = perfil.Id_p
            WHERE usuario.Nick = ? AND usuario.Pwd = ? AND usuario.Borrado = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $nick, $pwd);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        $_SESSION['usuario'] = $usuario['Nombre']; // Nombre del usuario
        $_SESSION['id_u'] = $usuario['Id_u']; // ID del usuario
        $_SESSION['perfil'] = $usuario['Perfil'] ?? 'No definido'; // Perfil del usuario
        $_SESSION['nick'] = $usuario['Nick']; // Nick del usuario
        header("Location: AdmUsuario/index.php");
        exit();
    } else {
        $mensaje = "Credenciales inválidas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<main style="margin: auto; padding: 40px;">
    <h2>Iniciar Sesión</h2>
    <form method="post">
        <label>Nick:</label><br>
        <input type="text" name="nick" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="pwd" required><br><br>
        <input type="submit" value="Ingresar">
        <p style="color: red"><?= $mensaje ?></p>
    </form>
</main>
</body>
</html>
