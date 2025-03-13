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
	<a href="./indexMtnRecomendada.php?view=add" class="btn-accion añadir">Añadir</a>

    <form action="../../../controller/controllerMmtRecomendada.php?action=delete" Method="post">  
			<div class="table-responsive">			
				<table id="table-mtnrecomendada" class="table-list" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>Patente</th>
				  		<th>Tipo de Mantención</th>
				  		<th>Fecha Recomendada</th>
				  		<th>Kilometraje Recomendado</th>
				  		<th width="10%" >Acción</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
						$mantencionrecomendada = new MantencionRecomendada();
						$mantencionrecomendadas = $mantencionrecomendada->list_of_mantencionrecomendada();

						foreach ($mantencionrecomendadas as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		echo '<td>' . $result['patente'].'</a></td>';

						$tipoMantencion = new TipoMantencion();
						$tipoMantencion = $tipoMantencion->single_tipo_mantencion($result['id_tipo_mtn']);
						
				  		echo '<td>'. $tipoMantencion->tipo_mantencion.'</td>';

				  		echo '<td>'. $result['fecha_recomen'].'</td>';
				  		echo '<td>'. $result['km_recomen'].'</td>';
				  		

				  		echo '<td align="center" > <a title="Editar" href="indexMtnRecomendada.php?view=edit&id_mtn_recomen='.$result['id_mtn_recomen'].'"  class="btn btn-edit btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Borrar" href="../../../controller/controllerMtnRecomendada.php?action=delete&id_mtn_recomen='.$result['id_mtn_recomen'].'" class="btn btn-delete btn-xs" ><span class="fa fa-trash-o fw-fa"></span> </a>
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