<?php
include_once '../config/conexion.php'; 
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

// Verificar si se recibió el ID del usuario
$id_u = $_POST['id_u'] ?? null;

if ($id_u) {
    // Obtener el estado actual del usuario
    $sql = "SELECT Borrado FROM usuario WHERE Id_u = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_u);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        die("Usuario no encontrado.");
    }

    // Cambiar el estado del usuario
    $nuevo_estado = ($user['Borrado'] == '1') ? '0' : '1'; // Alternar entre 1 (desactivado) y 0 (activo)
    $accion = ($nuevo_estado == '0') ? 'Activar' : 'Desactivar'; // Determinar la acción
    $sql_update = "UPDATE usuario SET Borrado = ? WHERE Id_u = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param('ii', $nuevo_estado, $id_u);

    if ($stmt_update->execute()) {
        // Obtener el ID del usuario que realizó la acción desde la sesión
        $sql_sesion = "SELECT Id_u FROM usuario WHERE nombre = ?";
        $stmt_sesion = $conn->prepare($sql_sesion);
        $stmt_sesion->bind_param('s', $_SESSION['usuario']);
        $stmt_sesion->execute();
        $result_sesion = $stmt_sesion->get_result();
        $usuario_sesion = $result_sesion->fetch_assoc();

        if (!$usuario_sesion) {
            die("Error: No se encontró un usuario en la sesión con el nombre: " . $_SESSION['usuario']);
        }

        // Registrar la acción en la bitácora
        $sql_bitacora = "INSERT INTO bitacora (fecha, hora, accion, id_u) VALUES (CURDATE(), NOW(), ?, ?)";
        $stmt_bitacora = $conn->prepare($sql_bitacora);
        $stmt_bitacora->bind_param('si', $accion, $usuario_sesion['Id_u']);
        $stmt_bitacora->execute();

        header("Location: index.php?success=1");
        exit();
    } else {
        die("Error al actualizar el estado del usuario: " . $conn->error);
    }
} else {
    die("ID de usuario no proporcionado.");
}
?>