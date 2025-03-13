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

		if ($_POST['tipo_vehiculo'] == "") {
			$messageStats = false;
			message("¡Los campos de nombre y categoria son obligatorios!", "error");
			redirect("../view/vehiculos/tipovehiculo/indexTipoVehiculo.php");
		} else {
			$tipovehiculo = new TipoVehiculo();
            $tipovehiculo->tipo_vehiculo = $_POST['tipo_vehiculo'];
            
			$tipovehiculo->create();
            
			message("¡Nuevo tipo de veh&iacute;culo registrado exitosamente!", "success");
			redirect("../view/vehiculos/tipovehiculo/indexTipoVehiculo.php");

		}
	}

}

function doEdit()
{
	if (isset($_POST['save'])) {

		$tipovehiculo = new TipoVehiculo();
        $tipovehiculo->tipo_vehiculo = $_POST['tipo_vehiculo'];
        $tipovehiculo->id_tipo_vehi = $_POST['id_tipo_vehi'];
		
        // Obtener la información actual del vehículo, incluida la imagen actual
        // $tipovehiculoActual = $tipovehiculo->single_tipovehiculo($_POST['id_tipo_vehi']); 

        $tipovehiculo->update($_POST['id_tipo_vehi']);

        message("El tipo de veh&iacute;culo [" . $_POST['tipo_vehiculo'] . "] ha sido actualizado!", "success");
        redirect("../view/vehiculos/tipovehiculo/indexTipoVehiculo.php");
    }
}


function doDelete() {
    echo "Tipo de Vehiculo";
    $id = isset($_GET['id_tipo_vehi']) ? intval($_GET['id_tipo_vehi']) : 0;
    if ($id <= 0) {
        die("ID inválido.");
        echo "Tipo de Vehiculo";
    }

    $tipovehiculo = new TipoVehiculo();
    $tipovehiculoSeleccionado = $tipovehiculo->single_tipovehiculo($id);
    if ($tipovehiculo->delete($id)) {
        echo "¡Tipo de vehiculo eliminado!";
        message("El tipo de veh&iacute;culo [" . $tipovehiculoSeleccionado->tipo_vehiculo . "] ha sido eliminado!", "success");
        // Aquí puedes redirigir o manejar la respuesta.
        redirect("../view/vehiculos/tipovehiculo/indexTipoVehiculo.php");
    } else {
        echo "Error al eliminar el tipo de vehiculo.";
        message("El tipo de veh&iacute;culo [" . $tipovehiculoSeleccionado->tipo_vehiculo . "] no ha podido ser eliminado!", "success");
        redirect("../view/vehiculos/tipovehiculo/indexTipoVehiculo.php");
    }
}

?>