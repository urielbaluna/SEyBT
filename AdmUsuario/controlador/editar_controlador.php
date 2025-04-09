<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/SEyBT/config/conexion.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SEyBT/AdmUsuario/modelo/editar_modelo.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$id_u = $_POST['id_u'] ?? $_GET['id_u'] ?? null;

if ($id_u) {
    // Obtener datos del usuario
    $user = obtenerUsuarioPorId($conn, $id_u);
    if (!$user) {
        die("Usuario no encontrado.");
    }

    // Obtener los perfiles disponibles
    $perfiles = obtenerPerfiles($conn);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? null;
    $nick = $_POST['nick'] ?? null;
    $edad = $_POST['edad'] ?? null;
    $pwd = $_POST['pwd'] ?? null;
    $perfil = $_POST['perfil'] ?? null;

    if ($nombre && $nick && $edad && $pwd && $perfil) {
        if (actualizarUsuario($conn, $id_u, $nombre, $nick, $edad, $pwd, $perfil)) {
            // Registrar la acción en la bitácora
            registrarBitacora($conn, "Editar usuario", $_SESSION['id_u']);
            header("Location: index.php?success=1");
            exit();
        } else {
            $error = "Error al actualizar el usuario.";
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>