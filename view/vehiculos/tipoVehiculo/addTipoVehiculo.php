<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gruas Plaza</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/vehiculos.css">
    <?php // include '../partial/head.php'; ?>
</head>
<body>

    <?php // include '../partial/header.php'; ?>
    <main>
        <h2>Agregar Tipo de Veh&iacute;culo</h2>
        <form action="<?= BASE_URL ?>controller/controllerTipoVehiculo.php?action=add" method="post" enctype="multipart/form-data" class="form-agregar-vehiculo">
            <div class="info-camion">

                <label for="tipo_vehiculo">Nombre del tipo de vehiculo:</label>
                <input type="text" id="tipo_vehiculo" name="tipo_vehiculo" required>

                <!-- Botón para agregar el vehículo -->
                <button type="submit" name="save">Añadir Tipo de Veh&iacute;culo</button>
            </div>

        </form>
    </main>
    <!-- Inicio Footer -->
    <footer>

        <?php 
        // include '../partial/footer.php'; 
        ?>
        <script src="<?= BASE_URL ?>public/js/vehiculos.js"></script>
    </footer>
        <!-- Fin Footer -->
</body>
</html>