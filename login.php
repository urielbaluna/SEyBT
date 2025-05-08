<?php
session_start();
include 'config/conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nick = $_POST['nick'];
    $pwd = $_POST['pwd'];

    // Modificar la consulta para incluir el perfil del usuario
    $sql = "SELECT usuario.Id_u, persona.nombre AS Nombre, usuario.Nick, perfil.Nombre AS Perfil
            FROM usuario
            LEFT JOIN perfil ON usuario.Id_p = perfil.Id_p
            JOIN persona ON usuario.Id_person = persona.id
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
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <main style="margin: auto; padding: 40px; background-color: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); width: 320px;">
        <h2 style="text-align: center; color: #2c3e50;">Iniciar Sesión</h2>
        <form method="post" style="text-align: center;">
            <label for="nick">Nick:</label><br>
            <input type="text" name="nick" id="nick" required
                style="width: 20%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; display: block; margin-left: auto; margin-right: auto;"><br>

            <label for="pwd">Contraseña:</label><br>
            <input type="password" name="pwd" id="pwd" required
                style="width: 20%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; display: block; margin-left: auto; margin-right: auto;"><br>

            <input type="submit" value="Ingresar"
                style="width: 15%; padding: 10px; background-color: #2980b9; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; display: block; margin: 0 auto;">

            <p style="color: #e74c3c; text-align: center; margin-top: 15px;"><?= $mensaje ?></p>
        </form>
    </main>
</body>
</html>