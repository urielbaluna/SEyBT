<?php 
include './controlador/controlador.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AdmModulo</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<aside>
    <div class="bienvenida">
        <p><strong>Bienvenido:</strong> <?= $_SESSION['usuario'] ?></p>
        <p><strong>Perfil:</strong> <?= $_SESSION['perfil'] ?? 'No definido' ?></p>
    </div>
    <?php foreach ($modulos as $modulo): ?>
        <a href="<?= '/SEyBT'.$modulo['url'] ?>"><?= $modulo['nombre'] ?></a>
    <?php endforeach; ?>
    <a href="../logout.php" style="color:red;">Cerrar sesión</a>
</aside>
<main>
    <h2>Módulos Registrados</h2>
    <table>
        <tr>
            <th>Perfil</th>
            <th>Módulos</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($groupedData as $perfil => $modulos): ?>
        <tr>
            <td><?= $perfil ?></td>
            <td>
                <form action="./actualizar_modulos.php" method="post">
                    <?php foreach ($modulos as $modulo): ?>
                        <label>
                            <input type="checkbox" name="modulos[]" value="<?= $modulo['Id_mod'] ?>" 
                                <?= $modulo['Asignado'] ? 'checked' : '' ?>>
                            <?= $modulo['Modulo'] ?>
                        </label><br>
                    <?php endforeach; ?>
                    <input type="hidden" name="perfil" value="<?= $perfil ?>">
            </td>
            <td>
                <input type="submit" value="Actualizar">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>