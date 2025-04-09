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
    $sql = "SELECT bitacora.Id_b, bitacora.fecha, bitacora.hora, bitacora.accion, usuario.Nombre, usuario.Nick 
            FROM bitacora 
            INNER JOIN usuario ON bitacora.Id_u = usuario.Id_u";
    if ($buscar) {
        $sql .= " WHERE usuario.Nombre LIKE ? OR usuario.Nick LIKE ?";
    }
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
?>