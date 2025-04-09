<?php
include_once '../config/conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $perfil = $_POST['perfil'];

    if (!isset($_SESSION['usuario'])) {
        die("Error: Usuario no autenticado.");
    }

    // Obtener el ID del perfil
    $sql = "SELECT Id_p FROM perfil WHERE Nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $perfil);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $id_p = $row['Id_p'] ?? null;
    $stmt->close();

    if (!$id_p) {
        die("Error: No se encontró el perfil en la base de datos.");
    }

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
    $usuario = $_SESSION['nick']; // Usuario que realiza la acción
    $accion = "Actualización de módulos para el perfil: $perfil. Módulos asignados: " . implode(", ", $modulosSeleccionados);

    // Depurar el valor de $_SESSION['usuario']
    if (empty($usuario)) {
        die("Error: El valor de la sesión 'usuario' está vacío.");
    }

    // Obtener el ID del usuario que realiza la acción
    $sql = "SELECT Id_u FROM usuario WHERE Nick = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $id_u = $row['Id_u'] ?? null;
    $stmt->close();

    if (!$id_u) {
        die("Error: No se encontró el usuario en la base de datos. Verifica que el valor de 'Nick' en la tabla 'usuario' coincida con '$_SESSION[usuario]'.");
    }

    // Insertar en la bitácora
    $sql = "INSERT INTO bitacora (Id_u, fecha, hora, accion) VALUES (?, CURDATE(), CURTIME(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id_u, $accion);
    if (!$stmt->execute()) {
        die("Error al registrar en la bitácora: " . $stmt->error);
    }
    $stmt->close();

    // Redirigir de vuelta a la vista
    header("Location: ./index.php");
    exit();
}
?>