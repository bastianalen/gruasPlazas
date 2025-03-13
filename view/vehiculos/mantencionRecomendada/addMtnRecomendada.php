<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gruas Plaza</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/mantenciones.css">
    <?php //include '../../partial/head.php'; ?>
</head>
<body>

    <?php //include '../../partial/header.php'; ?>
    <main>
        <h2>Agregar Mantenci&oacute;n Recomendada para el Vehiculo</h2>
        <form action="<?= BASE_URL ?>controller/controllerMtnRecomendada.php?action=add" method="post" enctype="multipart/form-data" class="form-agregar-mantencion">
            <div class="info-mantencion">
                <label for="tipo_mantencion">Tipo de mantenci&oacute;n recomendada</label>
                <select name="tipo_mantencion" id="tipo_mantencion">
                    <option value="0">Seleccione...</option>
                    <?php 
                        $tipoMantencion = new TipoMantencion();
                        $tipoMantenciones = $tipoMantencion->list_of_tipo_mantencion();
                        
                        foreach($tipoMantenciones as $tipo){
                            echo "<option value='" . $tipo['id_tipo_mtn'] . "'> " . $tipo['tipo_mantencion'] . "</option>";
                        }
                        ?>
                </select>
                
                <label for="patente">Patente del vehiculo relacionado:</label>
                <input type="text" id="patente" name="patente" maxlength="10" required>

                <label for="km_recomen">Kilometro recomendado para realizar la mantencion:</label>
                <input type="number" id="km_recomen" name="km_recomen" required>
                
                <label for="tiempo_recomen">Tiempo en meses recomendado para realizar la mantencion:</label>
                <input type="number" id="tiempo_recomen" name="tiempo_recomen" required>
                
                <label for="fecha_recomen">Fecha recomendada:</label>
                <input type="date" id="fecha_recomen" name="fecha_recomen" required>

                <label for="destacar">Destacar mantención recomendada</label>
                <input type="hidden" name="destacar" value="0">
                <input type="checkbox" name="destacar" id="destacar" value="1" style="height: 25px; width:25px;">

                <label for="desc_recomen">Descripci&oacute;n de Mantenci&oacute;n</label>
                <textarea name="desc_recomen" id="desc_recomen" style="height: 100px;"></textarea>

                <!-- Botón para agregar el vehículo -->
                <button type="submit" name="save">Agregar Mantencion</button>
            </div>

        </form>
    </main>
    <!-- Inicio Footer -->
    <footer>

        <?php 
        //include '../../partial/footer.php'; 
        ?>
        <script src="<?= BASE_URL ?>public/js/vehiculos.js"></script>
    </footer>
        <!-- Fin Footer -->
</body>
</html>