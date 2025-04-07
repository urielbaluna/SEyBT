<?php
include_once '../config/conexion.php';

function obtenerBitacora($conn) {
    $filtro = isset($_GET['buscar']) ? $_GET['buscar'] : '';
    $sql = "SELECT b.Id_b, b.fecha, b.hora, b.accion, u.Nombre, u.Nick
            FROM bitacora b
            JOIN usuario u ON b.Id_u = u.Id_u
            WHERE nick LIKE '%$filtro%'";
    return $conn->query($sql);
}
?>
