<?php 
include './controlador/editar_controlador.php'; 
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
            <?php foreach ($perfiles as $perfil): ?>
                <option value="<?= $perfil['Id_p'] ?>" <?= ($perfil['Id_p'] == $user['Id_p']) ? 'selected' : '' ?>>
                    <?= $perfil['Nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit" style="margin-top: 10px;">Guardar Cambios</button>
    </form>
    <a href="index.php" style="margin-top: 10px; display: inline-block;">Cancelar</a>
</main>
</body>
</html>