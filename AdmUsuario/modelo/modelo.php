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

function obtenerUsuarios($conn) {
    $sql = "SELECT usuario.Id_u, usuario.Nombre, usuario.Nick, usuario.Edad, usuario.Pwd, usuario.Borrado, perfil.Nombre AS Perfil
            FROM usuario
            LEFT JOIN perfil ON usuario.Id_p = perfil.Id_p";
    $result = $conn->query($sql);
    $usuarios = [];
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
    return $usuarios;
}
?>