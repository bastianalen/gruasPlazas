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
		<div class="titulo-botones-vehiculos">
			<h2>Categor&iacute;a de Mantenci&oacute;n</h2>
			<a href="./indexCateMtn.php?view=add" class="btn-accion añadir">Añadir</a>
        </div>

    <form action="../../../controller/controllerCateMtn.php?action=delete" Method="post">  
			<div class="table-responsive">			
				<table id="table-tipo-mtn" class="table-list" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>ID de Categor&iacute;a</th>
				  		<th>Nombre de Categor&iacute;a</th>
				  		<th width="10%" >Acción</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
						$categoriaMantencion = new CategoriaMantencion();
						$categoriaMantencion = $categoriaMantencion->list_of_categoria_mantencion();
						foreach ($categoriaMantencion as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		echo '<td>' . $result['id_cate_mtn'].'</a></td>';  
				  		echo '<td>'. $result['categoria_mtn'].'</td>';

				  		echo '<td align="center" > <a title="Editar" href="indexCateMtn.php?view=edit&id_cate_mtn='.$result['id_cate_mtn'].'"  class="btn btn-edit btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Borrar" href="../../../controller/controllerCateMtn.php?action=delete&id_cate_mtn='.$result['id_cate_mtn'].'" class="btn btn-delete btn-xs" ><span class="fa fa-trash-o fw-fa"></span> </a>
				  					 </td>';
				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
				</table>
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