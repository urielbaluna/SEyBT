<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/SEyBT/config/conexion.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SEyBT/AdmModulo/modelo/modelo.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

// Obtener el perfil del usuario
$perfil = $_SESSION['perfil'];

// Obtener los módulos habilitados para el perfil
$modulos = obtenerModulosPorPerfil($conn, $perfil);

// Obtener todos los módulos agrupados por perfil
$groupedData = obtenerTodosLosModulosPorPerfil($conn);
?>