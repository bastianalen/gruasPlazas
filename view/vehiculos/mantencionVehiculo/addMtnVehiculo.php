<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gruas Plaza</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/vehiculos.css">
    <?php //include '../partial/head.php'; ?>
</head>
<body>

    <?php //include '../partial/header.php'; ?>
    <main>
        <h2>Agregar Mantenci&oacute;n Vehículo</h2>
        <form action="<?= BASE_URL ?>controller/controllerMtnVehiculo.php?action=add" method="post" enctype="multipart/form-data" class="form-agregar-vehiculo">
            <div class="info-vehiculo">
                <label for="patente">Patente:</label>
                <input type="text" id="patente" name="patente" maxlength="10" required>
    
                <label for="id_tipo_mtn">Tipo Mantenci&oacute;n:</label>
                <select name="id_tipo_mtn" id="id_tipo_mtn">
                    <option value="0">Seleccione... </option>
                    <?php 
                        $tipomantencion = new TipoMantencion();
                        $tipos = $tipomantencion->list_of_tipo_mantencion();
                        
                        foreach($tipos as $tipo){
                            echo "<option value='" . $tipo['id_tipo_mtn'] . "'> ". $tipo['tipo_mantencion']. "</option>";
                        }
                    ?>
                </select>
    
                <label for="fecha_mtn">Fecha de mantenci&oacute;n:</label>
                <input type="date" id="fecha_mtn" name="fecha_mtn" required>
    
                <label for="lugar_mtn">Lugar donde se realiz&oacute; la mantenci&oacute;n:</label>
                <input type="text" id="lugar_mtn" name="lugar_mtn" required>
    
                <label for="costo_mtn">Costo de mantenci&oacute;n:</label>
                <input type="number" id="costo_mtn" name="costo_mtn" required>
    
                <label for="desc_mtn_vehi">Descripci&oacute;n de lo realizado en la mantenci&oacute;n:</label>
                <input type="text" id="desc_mtn_vehi" name="desc_mtn_vehi" required>
    
                <!-- Botón para agregar el vehículo -->
                <button type="submit" name="save">Agregar Mantenci&oacute;n</button>
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