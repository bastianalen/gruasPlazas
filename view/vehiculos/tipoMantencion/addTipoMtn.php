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
        <h2>Agregar Tipo de Mantenci&oacute;n</h2>
        <form action="<?= BASE_URL ?>controller/controllerTipoMtn.php?action=add" method="post" enctype="multipart/form-data" class="form-agregar-mantencion">
            <div class="info-mantencion">
                <label for="tipo_mantencion">Nombre del tipo de mantencion:</label>
                <input type="text" id="tipo_mantencion" name="tipo_mantencion" required>

                <label for="id_cate_mtn">Categor&iacute;a de mantenci&oacute;n</label>
                <select name="id_cate_mtn" id="id_cate_mtn">
                    <option value="0">Seleccione...</option>
                    <?php 
                        $categoria = new CategoriaMantencion();
                        $categorias = $categoria->list_of_categoria_mantencion();
                        
                        foreach($categorias as $cat){
                            echo "<option value='" . $cat['id_cate_mtn'] . "'> " . $cat['categoria_mtn'] . "</option>";
                        }
                        ?>
                </select>

                <label for="desc_tipo_mtn">Descripci&oacute;n del tipo de Mantenci&oacute;n</label>
                <textarea name="desc_tipo_mtn" id="desc_tipo_mtn" style="height: 100px;"></textarea>

                <!-- Botón para agregar el vehículo -->
                <button type="submit" name="save">Agregar Tipo de Mantencion</button>
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