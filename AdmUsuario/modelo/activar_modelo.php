<?php
function obtenerEstadoUsuario($conn, $id_u) {
    $sql = "SELECT Borrado FROM usuario WHERE Id_u = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_u);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function actualizarEstadoUsuario($conn, $id_u, $nuevo_estado) {
    $sql = "UPDATE usuario SET Borrado = ? WHERE Id_u = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $nuevo_estado, $id_u);
    return $stmt->execute();
}

function obtenerIdUsuarioSesion($conn, $usuario) {
    $sql = "SELECT Id_u FROM usuario WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function registrarBitacora($conn, $accion, $id_u) {
    $sql = "INSERT INTO bitacora (fecha, hora, accion, id_u) VALUES (CURDATE(), NOW(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $accion, $id_u);
    return $stmt->execute();
}
?>