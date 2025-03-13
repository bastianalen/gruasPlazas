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
			<h1>Mantenimientos de vehículos</h1>
			<a href="./indexMtnVehiculo.php?view=add" class="btn-accion añadir">Añadir</a>
		</div>
		<div class="filter-container">
			<h2 class="title-filter">Filtros</h2>

			<!-- Filtro por patente -->
			<div class="filter-div">
				<label for="patente" class="label-filter">Patente</label>
				<input type="text" class="filter" id="filter-patente" placeholder="ABCD42">
			</div>
			
			<!-- Filtro por fecha -->
			<div class="filter-div">
				<label for="fecha" class="label-filter">Fecha</label>
				<input type="date" class="filter" id="filter-fecha">
			</div>
			
			<!-- Filtro por tipo de mantención -->
			<div class="filter-div">
				<label for="tipo-mtn" class="label-filter">Tipo Mantenci&oacute;n</label>
				<select name="id_tipo_mtn" class="filter" id="filter-tipo-mtn">
					<option value="0">Seleccione tipo mantenci&oacute;n... </option>
					<?php 
						$tipomantencion = new TipoMantencion();
						$tipos = $tipomantencion->list_of_tipo_mantencion();
						
						foreach($tipos as $tipo){
							echo "<option value='" . $tipo['id_tipo_mtn'] . "'> ". $tipo['tipo_mantencion']. "</option>";
						}
						?>
				</select>
			</div>
			
			<!-- Filtro por categoría -->
			<div class=" filter-div">
				<label for="cate-mtn" class="label-filter">Categor&iacute;a</label>
				<select name="id_cate_mtn" class="filter" id="filter-cate-mtn">
					<option value="0">Seleccione categor&iacute;a... </option>
					<?php 
						$categoriamantencion = new CategoriaMantencion();
						$categorias = $categoriamantencion->list_of_categoria_mantencion();
						
						foreach($categorias as $cate){
							echo "<option value='" . $cate['id_cate_mtn'] . "'> ". $cate['categoria_mtn']. "</option>";
						}
						?>
				</select>
			</div>
			
			<!-- Filtro por lugar -->
			<div class="filter-div">
				<label for="lugar" class="label-filter">Lugar</label>
				<input type="text" class="filter" id="filter-lugar" placeholder="Taller Gruas Plaza">
			</div>
			
			<!-- Filtro por costo -->
			<div class="filter-div">
				<label for="costo" class="label-filter">Costo</label>
				<input type="number" class="filter" id="filter-costo" placeholder="0">
			</div>
			
			<!-- Filtro por descripcion -->
			<div class="filter-div">
				<label for="desc" class="label-filter">Descripci&oacute;n</label>
				<input type="text" class="filter" id="filter-desc" placeholder="Cambio de aceite de motor">
			</div>
			
			<!-- Filtro por destacados -->
			<div class="filter-div">
				<label for="destacado" class="label-filter">Destacado</label>
				<select name="destacar" class="filter" id="filter-destacar">
					<option value="0">Seleccionar mantenciones destacadas</option>
					<option value="2">No Destacados</option>
					<option value="1">Destacados</option>
				</select>
			</div>

			<!-- Botón para filtrar -->
			<button type="button" class="btn-filter">Filtrar</button>
		</div>
    	<form action="../../../controller/controllerMtnVehiculo.php?action=delete" Method="post">  
			<div class="table-responsive">			
				<table id="table-tipo-mtn" class="table-list" cellspacing="0">
				
					<thead>
						<tr>
							<th>Patente</th>
							<th>Fecha</th>
							<th>Tipo</th>
							<th>Categor&iacute;a</th>
							<th>Lugar</th>
							<th>Costo</th>
							<th>Descripci&oacute;n</th>
							<th width="10%" >Acción</th>
					
						</tr>	
					</thead> 
					<tbody id="table-body">
						<!-- Los datos serán cargados por AJAX -->
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
        <script src="<?= BASE_URL ?>public/js/mtnVehi.js"></script>
    </footer>
    <!-- Fin Footer -->
</body>
</html>