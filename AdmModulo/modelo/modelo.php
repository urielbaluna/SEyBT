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

function obtenerTodosLosModulosPorPerfil($conn) {
    $sql = "SELECT perfil.Nombre AS Perfil, modulo.Id_mod, modulo.Nombre AS Modulo, 
                   IF(mod_perfil.Id_p IS NOT NULL, 1, 0) AS Asignado
            FROM perfil
            CROSS JOIN modulo
            LEFT JOIN mod_perfil ON perfil.Id_p = mod_perfil.Id_p AND modulo.Id_mod = mod_perfil.Id_mod
            ORDER BY perfil.Nombre, modulo.Nombre";
    $result = $conn->query($sql);
    $groupedData = [];
    while ($row = $result->fetch_assoc()) {
        $groupedData[$row['Perfil']][] = $row;
    }
    return $groupedData;
}
?>