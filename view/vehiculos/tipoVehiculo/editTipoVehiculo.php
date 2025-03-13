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
    <?php 
        $id_tipo_vehi = $_GET['id_tipo_vehi'];
        $tipovehiculo = new TipoVehiculo();
        $tipovehiculos = $tipovehiculo->single_tipovehiculo($id_tipo_vehi);

    ?>
    <main>
        <h2>Actualizar Información del Tipo de Veh&iacute;culo: </h2>
        
        <form action="<?= BASE_URL ?>controller/controllerTipoVehiculo.php?action=edit" method="post" enctype="multipart/form-data" class="form-agregar-vehiculo">
            <div class="info-camion">
                <input type="hidden" name="id_tipo_vehi" value="<?php echo $tipovehiculos->id_tipo_vehi?>"> 

                <label for="tipo_vehiculo">Nombre del tipo de vehiculo:</label>
                <input type="text" id="tipo_vehiculo" name="tipo_vehiculo" value="<?php echo $tipovehiculos->tipo_vehiculo ?>" required>

                <!-- Botón para agregar el vehículo -->
                <button type="submit" name="save">Actualizar Tipo de Veh&iacute;culo</button>
            </div>

        </form>
    </main>
    <!-- Inicio Footer -->
    <footer>

        <?php 
        // include '../partial/footer.php'; 
        ?>
    </footer>
        <!-- Fin Footer -->
</body>
</html>