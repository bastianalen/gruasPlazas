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
    <?php 
        $patente = $_GET['patente'];
        $vehiculo = new Vehiculo();
        $vehiculos = $vehiculo->single_vehiculo($patente);

    ?>
    <main>
        <h2>Actualizar Información del Vehículo: </h2>
        <h3>  </h3>
        <form action="<?= BASE_URL ?>controller/controllerVehiculo.php?action=edit" method="post" enctype="multipart/form-data" class="form-agregar-vehiculo">
            <div class="info-vehiculo">
                <input type="hidden" name="id_vehiculo" value="<?php echo $vehiculos->id_vehiculo?>">

                <label for="patente">Patente:</label>
                <input type="text" id="patente" name="patente" maxlength="10" value="<?php echo $vehiculos->patente ?>" required>
    
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $vehiculos->nombre ?>" required>
    
                <label for="fecha_obtencion">Fecha de Obtención:</label>
                <input type="date" id="fecha_obtencion" name="fecha_obtencion" value="<?php echo $vehiculos->fecha_obtencion ?>" required>
    
                <label for="anio">Año:</label>
                <input type="number" id="anio" name="anio" min="1900" max="2099" value="<?php echo $vehiculos->anio ?>" required>
    
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" value="<?php echo $vehiculos->marca ?>" required>
    
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" value="<?php echo $vehiculos->modelo ?>" required>
    
                <label for="nro_motor">Número de Motor:</label>
                <input type="text" id="nro_motor" name="nro_motor" value="<?php echo $vehiculos->nro_motor ?>" required>
    
                <label for="nro_chasis">Número de Chasis:</label>
                <input type="text" id="nro_chasis" name="nro_chasis" value="<?php echo $vehiculos->nro_chasis ?>"  required>
    
                <label for="nro_vin">Número de VIN:</label>
                <input type="text" id="nro_vin" name="nro_vin" value="<?php echo $vehiculos->nro_vin ?>"  required>
    
                <label for="color">Color:</label>
                <input type="text" id="color" name="color" value="<?php echo $vehiculos->color ?>"  required>
    
                <label for="id_tipo_vehiculo">ID Tipo Vehículo:</label>
                <input type="number" id="id_tipo_vehiculo" name="id_tipo_vehiculo" value="<?php echo $vehiculos->id_tipo_vehiculo ?>"  required>
            </div>
            <div class="imagen-vehiculo">
                <h3 for="imagen_vehi">Imagen del Vehículo</h3>
                <!-- Contenedor para la vista previa -->
                <div id="vista-previa" >
                    <?php 
                    if ($vehiculos->imagen_vehi !== " "){
                        echo '<img src="'. BASE_URL. 'public/img/img_vehiculos/'. $vehiculos->imagen_vehi. '" alt="Imagen de '. $vehiculos->nombre. ' " style="max-width: 100%; max-height: 100%;">';
                    }else {
                        echo '<p >Vista previa</p>';
                    }
                    ?>
                </div>

                <!-- Input para seleccionar imagen -->
                <input type="file" id="imagen_vehi" name="imagen_vehi" accept="image/*">

                <!-- Botón para agregar el vehículo -->
                <button type="submit" name="save">Actualizar Vehículo</button>
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