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
		<div class="title">
			<h1>Tipos de veh&iacute;culos</h1>
			<a href="./indexTipoVehiculo.php?view=add" class="btn-accion añadir">Añadir</a>
		</div>

    	<form action="../../../controller/controllerTipoVehiculo.php?action=delete" Method="pos<t">  
			<div class="table-responsive">			
				<table id="table-tipo-mtn" class="table-list" cellspacing="0">
				
				  <thead>
				  	<tr>
						<th>ID de Veh&iacute;culo</th>
						<th>Tipo de Veh&iacute;culo</th>
				  		<th width="10%" >Acción</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
						$tipoVehiculo = new TipoVehiculo();
						$tipoVehiculo = $tipoVehiculo->list_of_tipovehiculo();

						foreach ($tipoVehiculo as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		echo '<td>'. $result['id_tipo_vehi'].'</td>';
				  		echo '<td>' . $result['tipo_vehiculo'].'</a></td>';  

				  		echo '<td align="center" > <a title="Editar" href="indexTipoVehiculo.php?view=edit&id_tipo_vehi='.$result['id_tipo_vehi'].'"  class="btn btn-edit btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Borrar" href="../../../controller/controllerTipoVehiculo.php?action=delete&id_tipo_vehi='.$result['id_tipo_vehi'].'" class="btn btn-delete btn-xs" ><span class="fa fa-trash-o fw-fa"></span> </a>
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