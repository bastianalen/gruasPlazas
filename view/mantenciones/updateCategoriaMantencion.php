<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gruas Plaza</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/mantenciones.css">
    <?php include '../partial/head.php'; ?>
</head>
<body>

    <?php include '../partial/header.php'; ?>
    <?php 
        $id_cate_mtn = $_GET['id_cate_mtn'];
        $categoriamantencion = new CategoriaMantencion();
        $categoriamantenciones = $categoriamantencion->single_categoria_mantencion($id_cate_mtn);

    ?>
    <main>
        <h2>Actualizar Información de la Mantenci&oacute;n Recomendada: </h2>
        <h3>  </h3>
        <form action="<?= BASE_URL ?>controller/controllerCategoriaMantencion.php?action=edit" method="post" enctype="multipart/form-data" class="form-agregar-mantencion">
            <div class="info-mantencion">
                <input type="hidden" name="id_cate_mtn" value="<?php echo $categoriamantenciones->id_cate_mtn?>"> 

                <label for="categoria_mtn">Nombre de la categoría de la mantenci&oacute;n:</label>
                <input type="text" id="categoria_mtn" name="categoria_mtn" value="<?php echo $categoriamantenciones->categoria_mtn ?>" required >
                
                <!-- Botón para agregar el vehículo -->
                <button type="submit" name="save">Actualizar Categor&iacute;a Mantenci&oacute;n</button>
            </div>

        </form>
    </main>
    <!-- Inicio Footer -->
    <footer>

        <?php 
        include '../partial/footer.php'; 
        ?>
        <script src="./vehiculos.js"></script>
    </footer>
        <!-- Fin Footer -->
</body>
</html>