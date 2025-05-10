<?php
function obtenerModulosPorPerfil($conn, $perfil) {
    $sql = "SELECT modulo.nombre, modulo.url 
            FROM modulo 
            INNER JOIN mod_perfil ON mod_perfil.Id_mod = modulo.Id_mod 
            WHERE mod_perfil.Id_p = (SELECT Id_p FROM perfil WHERE Nombre = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $perfil);
    $stmt->execute();
    $result = $stmt->get_result();
    $modulos = [];
    while ($row = $result->fetch_assoc()) {
        $modulos[] = $row;
    }
    $stmt->close();
    return $modulos;
}

function obtenerRegistrosBitacora($conn, $buscar = null) {
    $sql = "SELECT bitacora.Id_b, bitacora.fecha, bitacora.hora, bitacora.accion, persona.nombre AS Nombre, usuario.Nick 
            FROM bitacora
            LEFT JOIN usuario ON bitacora.id_u = usuario.Id_u
            LEFT JOIN persona ON usuario.Id_person = persona.id
            WHERE persona.Borrado = 0";
    if ($buscar) {
        $sql .= " AND (persona.nombre LIKE ? OR usuario.Nick LIKE ?)";
    }
    $sql .= " ORDER BY bitacora.Id_b DESC";
    $stmt = $conn->prepare($sql);
    if ($buscar) {
        $buscar = "%$buscar%";
        $stmt->bind_param("ss", $buscar, $buscar);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $registros = [];
    while ($row = $result->fetch_assoc()) {
        $registros[] = $row;
    }
    $stmt->close();
    return $registros;
}

function eliminarRegistroBitacora($conn, $id_b) {
    $sql = "DELETE FROM bitacora WHERE Id_b = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_b);
    return $stmt->execute();
}
?>