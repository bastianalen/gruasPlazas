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

		if ($_POST['tipo_mantencion'] == "" or $_POST['id_cate_mtn'] == "") {
			$messageStats = false;
			message("¡Los campos de nombre y categoria son obligatorios!", "error");
            echo "1: ";
            echo " - 2: ".$_POST['tipo_mantencion'];
            echo " - 4: ".$_POST['desc_tipo_mtn'];
            echo " - 3: ".$_POST['id_cate_mtn'];
            redirect("../view/vehiculos/tipoMantencion/indexTipoMtn.php");

		} else {
			$tipomantencion = new TipoMantencion();
            $tipomantencion->tipo_mantencion = $_POST['tipo_mantencion'];
            $tipomantencion->desc_tipo_mtn = $_POST['desc_tipo_mtn'];
            $tipomantencion->id_cate_mtn = $_POST['id_cate_mtn'];
            
			$tipomantencion->create();
            
			message("¡Nuevo tipo de mantenci&oacute;n registrado exitosamente!", "success");
            echo "2";
			redirect("../view/vehiculos/tipoMantencion/indexTipoMtn.php");

		}
	}

}

function doEdit()
{
	if (isset($_POST['save'])) {

		$tipomantencion = new TipoMantencion();
        $tipomantencion->tipo_mantencion = $_POST['tipo_mantencion'];
        $tipomantencion->desc_tipo_mtn = $_POST['desc_tipo_mtn'];
        $tipomantencion->id_cate_mtn = $_POST['id_cate_mtn'];
		
        // Obtener la información actual del vehículo, incluida la imagen actual
        // $$tipoMantencionActual = $tipomantencion->single_tipo_mantencion($_POST['id_tipo_mtn']); 

        $tipomantencion->update($_POST['id_tipo_mtn']);

        message("El tipo de mantenci&oacute;n [" . $_POST['tipo_mantencion'] . "] ha sido actualizada!", "success");
        redirect("../view/vehiculos/tipoMantencion/indexTipoMtn.php");

    }
}


function doDelete() {
    echo "Tipo de mantenci&oacute;n";
    $id = isset($_GET['id_tipo_mtn']) ? intval($_GET['id_tipo_mtn']) : 0;
    if ($id <= 0) {
        die("ID inválido.");
        echo "Tipo de mantenci&oacute;n";
    }

    $tipomantencion = new TipoMantencion();
    $tipomantencionSeleccionada = $tipomantencion->single_tipo_mantencion($id);
    if ($tipomantencion->delete($id)) {
        message("El tipo de mantenci&oacute;n llamado [" . $tipomantencionSeleccionada->tipo_mantencion . "] ha sido eliminado!", "success");
        redirect("../view/vehiculos/tipoMantencion/indexTipoMtn.php");

    } else {
        message("El tipo de mantenci&oacute;n llamado [" . $tipomantencionSeleccionada->tipo_mantencion . "] no ha podido ser eliminado!", "error");
        redirect("../view/vehiculos/tipoMantencion/indexTipoMtn.php");

    }
}

?>