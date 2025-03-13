<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/vehiculos.css">
    <?php //include '../partial/head.php'; ?>
</head>
<body>

    <?php //include '../partial/header.php'; ?>
    <main>
        <h2>Agregar Vehículo</h2>
        <form action="<?= BASE_URL ?>controller/controllerVehiculo.php?action=add" method="post" enctype="multipart/form-data" class="form-agregar-vehiculo">
            <div class="info-vehiculo">
                <label for="patente">Patente:</label>
                <input type="text" id="patente" name="patente" maxlength="10" required>
    
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
    
                <label for="fecha_obtencion">Fecha de Obtención:</label>
                <input type="date" id="fecha_obtencion" name="fecha_obtencion" required>
    
                <label for="anio">Año:</label>
                <input type="number" id="anio" name="anio" min="1900" max="2099" required>
    
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" required>
    
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" required>
    
                <label for="nro_motor">Número de Motor:</label>
                <input type="text" id="nro_motor" name="nro_motor" required>
    
                <label for="nro_chasis">Número de Chasis:</label>
                <input type="text" id="nro_chasis" name="nro_chasis" required>
    
                <label for="nro_vin">Número de VIN:</label>
                <input type="text" id="nro_vin" name="nro_vin" required>
    
                <label for="color">Color:</label>
                <input type="text" id="color" name="color" required>
    
                <label for="tipo_vehiculo">ID Tipo Vehículo:</label>
                <select name="id_tipo_vehiculo" id="id_tipo_vehiculo">
                    <option value="0">Seleccione... </option>
                    <?php 
                        $tipovehiculo = new TipoVehiculo();
                        $tiposvehiculo = $tipovehiculo->list_of_tipovehiculo();
                        
                        foreach($tiposvehiculo as $tipo){
                            echo "<option value='" . $tipo['id_tipo_vehi'] . "'> ". $tipo['tipo_vehiculo']. "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="imagen-vehiculo">
                <h3 for="imagen_vehi">Imagen del Vehículo</h3>
                <!-- Contenedor para la vista previa -->
                <div id="vista-previa" >
                    <p >Vista previa</p>
                </div>

                <!-- Input para seleccionar imagen -->
                <input type="file" id="imagen_vehi" name="imagen_vehi" accept="image/*">

                <!-- Botón para agregar el vehículo -->
                <button type="submit" name="save">Agregar Vehículo</button>
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