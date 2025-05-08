<?php
function obtenerUsuarioPorId($conn, $id_u) {
    $sql = "SELECT usuario.id_u, persona.Nombre, usuario.Nick, persona.Edad, usuario.Pwd, usuario.Id_p
            FROM usuario
            LEFT JOIN persona ON usuario.Id_person = persona.id
            WHERE usuario.Id_u = ? AND persona.Borrado = 0";
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
    // Actualizar persona
    $sql0 = "UPDATE persona SET Nombre = ?, Edad = ? WHERE id = (SELECT Id_person FROM usuario WHERE id_u = ?)";
    $stmt0 = $conn->prepare($sql0);
    $stmt0->bind_param('ssi', $nombre, $edad, $id_u);
    if (!$stmt0->execute()) {
        $stmt0->close();
        return false;
    }
    $stmt0->close();

    // Actualizar usuario
    $sql = "UPDATE usuario SET Nick = ?, Pwd = ?, Id_p = ? WHERE id_u = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssii', $nick, $pwd, $perfil, $id_u);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

function registrarBitacora($conn, $accion, $id_u) {
    $sql = "INSERT INTO bitacora (fecha, hora, accion, id_u) VALUES (CURDATE(), NOW(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $accion, $id_u);
    return $stmt->execute();
}
?>