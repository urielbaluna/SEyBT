<?php 
include './controlador/agregar_controlador.php'; 
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
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
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
            <?php foreach ($perfiles as $perfil): ?>
                <option value="<?= $perfil['Id_p'] ?>"><?= $perfil['Nombre'] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit" style="margin-top: 10px;">Agregar Usuario</button>
    </form>
    <a href="index.php" style="margin-top: 10px; display: inline-block;">Cancelar</a>
</main>
</body>
</html>