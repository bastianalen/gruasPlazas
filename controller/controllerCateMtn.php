<?php
require_once("initialize.php");

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
    case 'add':
		doInsert();
		break;
        
    case 'edit':
        doEdit();
        break;
        
    case 'delete':
        doDelete();
        break;
        
}

function doInsert()
{
    if (isset($_POST['save'])) {

		if ($_POST['categoria_mtn'] == "") {
			$messageStats = false;
			message("¡Los campos son obligatorios!", "error");
			redirect('../view/vehiculos/categoriaMtn/indexCateMtn.php');
		} else {
			$categoriamantencion = new CategoriaMantencion();
            $categoriamantencion->categoria_mtn = $_POST['categoria_mtn'];
            
			$categoriamantencion->create();
            
			message("¡Nueva categoria de mantenci&oacute;n registrada exitosamente!", "success");
			redirect('../view/vehiculos/categoriaMtn/indexCateMtn.php');

		}
	}
}

function doEdit()
{
	if (isset($_POST['save'])) {

		$categoriamantencion = new CategoriaMantencion();
        $categoriamantencion->categoria_mtn = $_POST['categoria_mtn'];

        $categoriamantencion->update($_POST['id_cate_mtn']);
        message("La categoria de mantenci&oacute;n [" . $_POST['categoria_mtn'] . "] ha sido actualizada!", "success");
        redirect('../view/vehiculos/categoriaMtn/indexCateMtn.php');
    }
}


function doDelete() {
    echo "Categoria de Mantencion";
    $id = isset($_GET['id_cate_mtn']) ? intval($_GET['id_cate_mtn']) : 0;
    if ($id <= 0) {
        die("ID inválido.");
        echo "Categoria de Mantencion";
    }

    $categoriamantencion = new CategoriaMantencion();
    $categoriamantencionSeleccionada = $categoriamantencion->single_categoria_mantencion($id);
    if ($categoriamantencion->delete($id)) {
        message("La categor&iacute;a de mantenci&oacute;n llamada [" . $categoriamantencionSeleccionada->categoria_mtn . "] ha sido eliminada!", "success");
        redirect('../view/vehiculos/categoriaMtn/indexCateMtn.php');

    } else {
        message("La categor&iacute;a de mantenci&oacute;n llamada [" . $categoriamantencionSeleccionada->categoria_mtn . "] no ha podido ser eliminada!", "error");
        redirect('../view/vehiculos/categoriaMtn/indexCateMtn.php');

    }
}

?>