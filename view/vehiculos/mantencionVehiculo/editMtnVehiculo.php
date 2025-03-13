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
    <?php 
        $id_mtn_vehiculo = $_GET['id_mtn_vehiculo'];
        $mtnvehiculo = new MantencionVehiculo();
        $mtnsvehiculo = $mtnvehiculo->single_mantencion($id_mtn_vehiculo);
        // echo "console.log(".json_encode($mtnsvehiculo->id_mtn_vehiculo).")";
    ?>
    <main>
        <h2>Actualizar Información de la Mantenci&oacute;n del vehiculo: <?php echo $mtnsvehiculo->patente?></h2>

        <form action="<?= BASE_URL ?>controller/controllerMtnVehiculo.php?action=edit" method="post" enctype="multipart/form-data" class="form-agregar-mantencion">
            <div class="info-mantencion">
                <input type="hidden" name="id_mtn_vehiculo" value="<?php echo $mtnsvehiculo->id_mtn_vehiculo?>"> 

                <label for="patente">Patente:</label>
                <input type="text" id="patente" name="patente" value="<?php echo $mtnsvehiculo->patente ?>" required>

                <label for="fecha_mtn">Fecha de mantenci&oacute;n:</label>
                <input type="date" id="fecha_mtn" name="fecha_mtn" value="<?php echo $mtnsvehiculo->fecha_mtn ?>" required>
                
                <label for="cate_mtn">Categor&iacute;a de mantenci&oacute;n</label>
                <select name="id_cate_mtn" id="id_cate_mtn">
                    <option value="0">Seleccione...</option>
                    <?php 
                        $categoria = new CategoriaMantencion();
                        $categorias = $categoria->list_of_categoria_mantencion();
                        
                        foreach($categorias as $cat){
                            
                            if($cat['id_cate_mtn'] == $mtnsvehiculo->id_cate_mtn) {
                                echo "<option value='" . $cat['id_cate_mtn'] . "' selected> " . $cat['categoria_mtn'] . "</option>";
                            }else {
                                echo "<option value='" . $cat['id_cate_mtn'] . "'> " . $cat['categoria_mtn'] . "</option>";
                            }
                        }
                        ?>
                </select>
                
                <label for="tipo_mtn">Tipo Mantenci&oacute;n:</label>
                <select name="id_tipo_mtn" id="id_tipo_mtn">
                    <option value="0">Seleccione... </option>
                    <?php 
                        $tipomantencion = new TipoMantencion();
                        $tipos = $tipomantencion->list_of_tipo_mantencion();
                        
                        foreach($tipos as $tipo){
                            if($mtnsvehiculo->id_tipo_mtn == $tipo['id_tipo_mtn']) {
                                echo "<option value='" . $tipo['id_tipo_mtn'] . "' selected> ". $tipo['tipo_mantencion']. "</option>";
                            }else{
                                echo "<option value='" . $tipo['id_tipo_mtn'] . "'> ". $tipo['tipo_mantencion']. "</option>";
                            }
                        }
                    ?>
                </select>

                <label for="lugar_mtn">Lugar donde se realiz&oacute; la mantenci&oacute;n:</label>
                <input type="text" id="lugar_mtn" name="lugar_mtn" value="<?php echo $mtnsvehiculo->lugar_mtn ?>" required>

                <label for="costo_mtn">Costo de mantenci&oacute;n:</label>
                <input type="number" id="costo_mtn" name="costo_mtn" value="<?php echo $mtnsvehiculo->costo_mtn ?>" required>

                <label for="desc_mtn_vehi">Descripci&oacute;n del tipo de Mantenci&oacute;n</label>
                <textarea name="desc_mtn_vehi" id="desc_mtn_vehi" style="height: 100px;"><?php echo $mtnsvehiculo->desc_mtn_vehi?></textarea>

                <!-- Botón para agregar el vehículo -->
                <button type="submit" name="save">Actualizar Mantenci&oacute;n</button>
            </div>

        </form>
    </main>
    <!-- Inicio Footer -->
    <footer>

        <?php 
        //include '../partial/footer.php'; 
        ?>
        <script src="<?= BASE_URL ?>public/js/mtnVehi.js"></script>
    </footer>
        <!-- Fin Footer -->
</body>
</html>