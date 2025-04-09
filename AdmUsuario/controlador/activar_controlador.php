<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/SEyBT/config/conexion.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SEyBT/AdmUsuario/modelo/activar_modelo.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

// Verificar si se recibió el ID del usuario
$id_u = $_POST['id_u'] ?? null;

if ($id_u) {
    // Obtener el estado actual del usuario
    $user = obtenerEstadoUsuario($conn, $id_u);
    if (!$user) {
        die("Usuario no encontrado.");
    }

    // Cambiar el estado del usuario
    $nuevo_estado = ($user['Borrado'] == '1') ? '0' : '1'; // Alternar entre 1 (desactivado) y 0 (activo)
    $accion = ($nuevo_estado == '0') ? 'Activar' : 'Desactivar'; // Determinar la acción

    if (actualizarEstadoUsuario($conn, $id_u, $nuevo_estado)) {
        // Obtener el ID del usuario que realizó la acción desde la sesión
        $usuario_sesion = obtenerIdUsuarioSesion($conn, $_SESSION['usuario']);
        if (!$usuario_sesion) {
            die("Error: No se encontró un usuario en la sesión con el nombre: " . $_SESSION['usuario']);
        }

        // Registrar la acción en la bitácora
        registrarBitacora($conn, $accion, $usuario_sesion['Id_u']);

        header("Location: ../index.php?success=1");
        exit();
    } else {
        die("Error al actualizar el estado del usuario: " . $conn->error);
    }
} else {
    die("ID de usuario no proporcionado.");
}
?>