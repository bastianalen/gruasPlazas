<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gruas Plaza</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/mantenciones.css">
    <?php //include '../partial/head.php'; ?>
</head>
<body>

    <?php //include '../partial/header.php'; ?>
    <main>
        <h2>Agregar Categor&iacute; de Mantenci&oacute;n</h2>
        <form action="<?= BASE_URL ?>controller/controllerCateMtn.php?action=add" method="post" enctype="multipart/form-data" class="form-agregar-mantencion">
            <div class="info-mantencion"> 

                <label for="categoria_mantencion">Nombre de la categor&iacute;a de mantenci&oacute;n:</label>
                <input type="text" id="categoria_mtn" name="categoria_mtn" required>

                <!-- Botón para agregar el vehículo -->
                <button type="submit" name="save">Agregar Categor&iacute; de Mantenci&oacute;n</button>
            </div>

        </form>
    </main>
    <!-- Inicio Footer -->
    <footer>

        <?php 
        //include '../partial/footer.php'; 
        ?>
        <script src="<?= BASE_URL ?>public/js/vehiculos.js"></script>
    </footer>
        <!-- Fin Footer -->
</body>
</html>