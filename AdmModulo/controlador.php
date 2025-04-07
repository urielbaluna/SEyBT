<?php
include 'modelo.php';
include_once '../config/conexion.php'; // This will include the $conn object

// Ensure $conn is available and valid
if (!isset($conn) || $conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Use $conn directly
$modulos = obtenerModulos($conn);
?>
