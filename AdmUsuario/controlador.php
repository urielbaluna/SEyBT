<?php
include_once '../config/conexion.php';

$sql = "SELECT usuario.Id_u, usuario.Nombre, usuario.Nick, usuario.Edad, usuario.Pwd, usuario.Borrado, perfil.Nombre AS Perfil
        FROM usuario
        LEFT JOIN perfil ON usuario.Id_p = perfil.Id_p";
$usuarios = $conn->query($sql);

if (!$usuarios) {
    die("Error al obtener los usuarios: " . $conn->error);
}
?>