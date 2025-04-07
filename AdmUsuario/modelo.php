<?php
include_once '../config/conexion.php';

function obtenerUsuarios($conn) {
    $sql = "SELECT u.Id_u, u.Nombre, u.Nick, u.Edad, u.Pwd, p.Nombre as Perfil
            FROM usuario u
            JOIN perfil p ON u.Id_p = p.Id_p
            WHERE u.Borrado = 0
            ORDER BY u.Nombre";
    return $conn->query($sql);
}
?>
