<?php
include_once '../config/conexion.php';
include_once './modelo/modelo.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_b = $_POST['id_b'] ?? null;

    if ($id_b) {
        if (eliminarRegistroBitacora($conn, $id_b)) {
            header("Location: index.php?success=1");
            exit();
        } else {
            die("Error al eliminar el registro: " . $conn->error);
        }
    } else {
        die("ID de registro no proporcionado.");
    }
}
?>