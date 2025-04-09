<?php
include_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $perfil = $_POST['perfil'];

    // Obtener el ID del perfil
    $sql = "SELECT Id_p FROM perfil WHERE Nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $perfil);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $id_p = $row['Id_p'];
    $stmt->close();

    // Eliminar los módulos actuales del perfil
    $sql = "DELETE FROM mod_perfil WHERE Id_p = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_p);
    $stmt->execute();
    $stmt->close();

    // Insertar los nuevos módulos seleccionados
    $modulosSeleccionados = $_POST['modulos'] ?? [];
    if (!empty($modulosSeleccionados)) {
        $sql = "INSERT INTO mod_perfil (Id_p, Id_mod) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        foreach ($modulosSeleccionados as $id_mod) {
            $stmt->bind_param("ii", $id_p, $id_mod);
            $stmt->execute();
        }
        $stmt->close();
    }

    // Registrar en la bitácora
    $usuario = $_SESSION['usuario']; // Usuario que realiza la acción
    $accion = "Actualización de módulos para el perfil: $perfil. Módulos asignados: " . implode(", ", $modulosSeleccionados);
    $sql = "INSERT INTO bitacora (Id_u, fecha, hora, accion) VALUES (
                (SELECT Id_u FROM usuario WHERE Nick = ?), 
                CURDATE(), 
                CURTIME(), 
                ?
            )";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $accion);
    $stmt->execute();
    $stmt->close();

    // Redirigir de vuelta a la vista
    header("Location: ./index.php");
    exit();
}
?>