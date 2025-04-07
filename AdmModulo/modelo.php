<?php
function obtenerModulos($conn) {
    $sql = "SELECT perfil.nombre AS Perfil, modulo.nombre AS Modulos, modulo.borrado as Borrado
            FROM mod_perfil 
            JOIN modulo 
                ON mod_perfil.id_mod=modulo.id_mod 
            JOIN perfil 
                ON mod_perfil.id_p=perfil.id_p 
            WHERE perfil.borrado=0 
            AND modulo.borrado=0 
            ORDER BY perfil.nombre, modulo.nombre";
    $resultado = $conn->query($sql);
    if (!$resultado) {
        die("Error en la consulta: " . $conn->error);
    }
    return $resultado;
}
