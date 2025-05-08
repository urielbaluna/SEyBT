<?php
function obtenerPerfiles($conn) {
    $sql = "SELECT Id_p, Nombre FROM perfil WHERE Borrado = 0";
    $result = $conn->query($sql);
    $perfiles = [];
    while ($row = $result->fetch_assoc()) {
        $perfiles[] = $row;
    }
    return $perfiles;
}

function agregarUsuario($conn, $nombre, $nick, $edad, $pwd, $perfil) {

    // Insertar el nuevo usuario con un procedimiento almacenado
    $sql = "CALL RegistrarUsuario(?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sisssi', $nombre, $edad, $nick, $nick, $pwd, $perfil);
    return $stmt->execute();
}

function registrarBitacora($conn, $accion, $id_u) {
    $sql = "INSERT INTO bitacora (fecha, hora, accion, id_u) VALUES (CURDATE(), NOW(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $accion, $id_u);
    return $stmt->execute();
}
?>