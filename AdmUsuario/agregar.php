<?php
session_start();
include '../config/conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? null;
    $nick = $_POST['nick'] ?? null;
    $edad = $_POST['edad'] ?? null;
    $pwd = $_POST['pwd'] ?? null;
    $perfil = $_POST['perfil'] ?? null;

    $last_id = $conn->query("select MAX(id_u) from usuario;");
        //object a int
        $last_id = $last_id->fetch_assoc();
        $last_id = $last_id['MAX(id_u)'];
        $last_id = (int)$last_id + 1;
    
    if ($nombre && $nick && $edad && $pwd && $perfil) {
        $sql = "INSERT INTO usuario (id_u, Nombre, Nick, Edad, Pwd, Id_p, Borrado) VALUES (?, ?, ?, ?, ?, ?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issisi',$last_id, $nombre, $nick, $edad, $pwd, $perfil);

        if ($stmt->execute()) {
            // Registrar la acción en la bitácora
            $accion = "Agregar usuario";
            $sql_bitacora = "INSERT INTO bitacora (fecha, hora, accion, id_u) VALUES (CURDATE(), NOW(), ?, ?)";
            $stmt_bitacora = $conn->prepare($sql_bitacora);
            $stmt_bitacora->bind_param('si', $accion, $_SESSION['id_u']);
            $stmt_bitacora->execute();

            header("Location: index.php?success=1");
            exit();
        } else {
            $mensaje = "Error al agregar el usuario: " . $conn->error;
        }
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}

// Obtener los perfiles disponibles
$sql_perfiles = "SELECT Id_p, Nombre FROM perfil WHERE Borrado = 0";
$result_perfiles = $conn->query($sql_perfiles);
if (!$result_perfiles) {
    die("Error al obtener los perfiles: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<main>
    <h2>Agregar Usuario</h2>
    <?php if ($mensaje): ?>
        <p style="color: red;"><?= $mensaje ?></p>
    <?php endif; ?>
    <form action="agregar.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="nick">Nick:</label>
        <input type="text" id="nick" name="nick" required>
        <br>
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required>
        <br>
        <label for="pwd">Contraseña:</label>
        <input type="password" id="pwd" name="pwd" required>
        <br>
        <label for="perfil">Perfil:</label>
        <select id="perfil" name="perfil" required>
            <option value="">Seleccione un perfil</option>
            <?php while ($perfil = $result_perfiles->fetch_assoc()): ?>
                <option value="<?= $perfil['Id_p'] ?>"><?= $perfil['Nombre'] ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <button type="submit" style="margin-top: 10px;">Agregar Usuario</button>
    </form>
    <a href="index.php" style="margin-top: 10px; display: inline-block;">Cancelar</a>
</main>
</body>
</html>