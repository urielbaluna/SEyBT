<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/SEyBT/config/conexion.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SEyBT/AdmBitacora/modelo/modelo.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

// Obtener el perfil del usuario
$perfil = $_SESSION['perfil'];

// Obtener los módulos habilitados para el perfil
$modulos = obtenerModulosPorPerfil($conn, $perfil);

// Obtener los registros de la bitácora (con búsqueda opcional)
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : null;
$registros = obtenerRegistrosBitacora($conn, $buscar);
?>