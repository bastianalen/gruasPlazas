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
			<h2>Tipo de Mantenci&oacute;n</h2>
			<a href="./indexTipoMtn.php?view=add" class="btn-accion añadir">Añadir</a>
        </div>

    <form action="../../../controller/controllerMtnRecomendada.php?action=delete" Method="post">  
			<div class="table-responsive">			
				<table id="table-tipo-mtn" class="table-list" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>Tipo de Mantenci&oacute;n</th>
				  		<th>Descripci&oacute;n</th>
				  		<th>Categor&iacute;a de Mantenci&oacute;n</th>
				  		<th width="10%" >Acción</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
						$tipoMantencion = new TipoMantencion();
						$tipoMantencion = $tipoMantencion->list_of_tipo_mantencion();

						foreach ($tipoMantencion as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		echo '<td>' . $result['tipo_mantencion'].'</a></td>';  
				  		echo '<td>'. $result['desc_tipo_mtn'].'</td>';

						$categoriaMantencion = new CategoriaMantencion();
						$categoriaMantencion = $categoriaMantencion->single_categoria_mantencion($result['id_cate_mtn']);
						echo '<td>'. $categoriaMantencion->categoria_mtn.'</td>';

				  		echo '<td align="center" > <a title="Editar" href="indexTipoMtn.php?view=edit&id_tipo_mtn='.$result['id_tipo_mtn'].'"  class="btn btn-edit btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Borrar" href="../../../controller/controllerTipoMtn.php?action=delete&id_tipo_mtn='.$result['id_tipo_mtn'].'" class="btn btn-delete btn-xs" ><span class="fa fa-trash-o fw-fa"></span> </a>
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