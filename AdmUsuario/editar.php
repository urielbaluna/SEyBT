<?php
include_once '../config/conexion.php'; 
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$id_u = $_POST['id_u'] ?? $_GET['id_u'] ?? null;

if ($id_u) {
    // Obtener datos del usuario
    $sql = "SELECT * FROM usuario WHERE Id_u = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_u);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        die("Usuario no encontrado.");
    }

    // Obtener los perfiles disponibles
    $sql_perfiles = "SELECT Id_p, Nombre FROM perfil WHERE Borrado = 0";
    $result_perfiles = $conn->query($sql_perfiles);

    if (!$result_perfiles) {
        die("Error al obtener los perfiles: " . $conn->error);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? null;
    $nick = $_POST['nick'] ?? null;
    $edad = $_POST['edad'] ?? null;
    $pwd = $_POST['pwd'] ?? null;
    $perfil = $_POST['perfil'] ?? null;

    if ($nombre && $nick && $edad && $pwd && $perfil) {
        $sql = "UPDATE usuario SET Nombre = ?, Nick = ?, Edad = ?, Pwd = ?, Id_p = ? WHERE Id_u = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssissi', $nombre, $nick, $edad, $pwd, $perfil, $id_u);

        if ($stmt->execute()) {
            // Registrar la acción en la bitácora
            $accion = "Editar usuario";
            $sql_bitacora = "INSERT INTO bitacora (fecha, hora, accion, id_u) VALUES (CURDATE(), NOW(), ?, ?)";
            $stmt_bitacora = $conn->prepare($sql_bitacora);
            $stmt_bitacora->bind_param('si', $accion, $_SESSION['id_u']);
            $stmt_bitacora->execute();

            header("Location: index.php?success=1");
            exit();
        } else {
            $error = "Error al actualizar el usuario: " . $conn->error;
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<main>
    <h2>Editar Usuario</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <p><strong>Usuario a editar:</strong> <?= $user['Nombre'] ?? 'Desconocido' ?> (ID: <?= $user['Id_u'] ?? 'N/A' ?>)</p>
    <form action="editar.php" method="post">
        <input type="hidden" name="id_u" value="<?= $user['Id_u'] ?? '' ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= $user['Nombre'] ?? '' ?>" required>
        <br>
        <label for="nick">Nick:</label>
        <input type="text" id="nick" name="nick" value="<?= $user['Nick'] ?? '' ?>" required>
        <br>
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="<?= $user['Edad'] ?? '' ?>" required>
        <br>
        <label for="pwd">Contraseña:</label>
        <input type="password" id="pwd" name="pwd" value="<?= $user['Pwd'] ?? '' ?>" required>
        <br>
        <label for="perfil">Perfil:</label>
        <select id="perfil" name="perfil" required>
            <option value="">Seleccione un perfil</option>
            <?php while ($perfil = $result_perfiles->fetch_assoc()): ?>
                <option value="<?= $perfil['Id_p'] ?>" <?= ($perfil['Id_p'] == $user['Id_p']) ? 'selected' : '' ?>>
                    <?= $perfil['Nombre'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br>
        <!-- Botón de guardar cambios -->
        <button type="submit" style="margin-top: 10px;">Guardar Cambios</button>
    </form>
    <a href="index.php" style="margin-top: 10px; display: inline-block;">Cancelar</a>
</main>
</body>
</html>