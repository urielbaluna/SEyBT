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
    // Obtener el último ID de usuario
    $result = $conn->query("SELECT MAX(Id_u) AS max_id FROM usuario");
    $row = $result->fetch_assoc();
    $last_id = (int)$row['max_id'] + 1;

    // Insertar el nuevo usuario
    $sql = "INSERT INTO usuario (Id_u, Nombre, Nick, Edad, Pwd, Id_p, Borrado) VALUES (?, ?, ?, ?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('issisi', $last_id, $nombre, $nick, $edad, $pwd, $perfil);
    return $stmt->execute();
}

function registrarBitacora($conn, $accion, $id_u) {
    $sql = "INSERT INTO bitacora (fecha, hora, accion, id_u) VALUES (CURDATE(), NOW(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $accion, $id_u);
    return $stmt->execute();
}
?>