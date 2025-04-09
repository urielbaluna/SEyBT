<?php
function obtenerUsuarioPorId($conn, $id_u) {
    $sql = "SELECT * FROM usuario WHERE Id_u = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_u);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function obtenerPerfiles($conn) {
    $sql = "SELECT Id_p, Nombre FROM perfil WHERE Borrado = 0";
    $result = $conn->query($sql);
    $perfiles = [];
    while ($row = $result->fetch_assoc()) {
        $perfiles[] = $row;
    }
    return $perfiles;
}

function actualizarUsuario($conn, $id_u, $nombre, $nick, $edad, $pwd, $perfil) {
    $sql = "UPDATE usuario SET Nombre = ?, Nick = ?, Edad = ?, Pwd = ?, Id_p = ? WHERE Id_u = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssissi', $nombre, $nick, $edad, $pwd, $perfil, $id_u);
    return $stmt->execute();
}

function registrarBitacora($conn, $accion, $id_u) {
    $sql = "INSERT INTO bitacora (fecha, hora, accion, id_u) VALUES (CURDATE(), NOW(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $accion, $id_u);
    return $stmt->execute();
}
?>