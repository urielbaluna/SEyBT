<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/SEyBT/config/conexion.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SEyBT/AdmUsuario/modelo/agregar_modelo.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? null;
    $nick = $_POST['nick'] ?? null;
    $email = $_POST['email'] ?? null;
    $edad = $_POST['edad'] ?? null;
    $pwd = $_POST['pwd'] ?? null;
    $perfil = $_POST['perfil'] ?? null;

    if ($nombre && $nick && $email && $edad && $pwd && $perfil) {
        if (agregarUsuario($conn, $nombre, $nick, $email, $edad, $pwd, $perfil)) {
            // Registrar la acción en la bitácora
            registrarBitacora($conn, "Agregar usuario", $_SESSION['id_u']);
            header("Location: index.php?success=1");
            exit();
        } else {
            $mensaje = "Error al agregar el usuario: " . $conn->error;
        }
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}

// Obtener los perfiles disponibles
$perfiles = obtenerPerfiles($conn);
?>