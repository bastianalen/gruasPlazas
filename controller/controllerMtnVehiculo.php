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

		if ($_POST['patente'] == "" or $_POST['id_tipo_mtn'] == "" or $_POST['fecha_mtn'] == "" or $_POST['lugar_mtn'] == "" or $_POST['costo_mtn'] == "") {
			$messageStats = false;
			message("¡Todos los campos son obligatorios!", "error");
            echo "1: ";
            echo " - 2: ".$_POST['patente'];
            echo " - 3: ".$_POST['id_tipo_mtn'];
            echo " - 4: ".$_POST['fecha_mtn'];
            echo " - 5: ".$_POST['lugar_mtn'];
            echo " - 6: ".$_POST['costo_mtn'];
			redirect('../view/vehiculos/mantencionVehiculo/indexMtnVehiculo.php');
		} else {
			$mantencionvehiculo = new MantencionVehiculo();
            $mantencionvehiculo->patente = $_POST['patente'];
            $mantencionvehiculo->id_tipo_mtn = $_POST['id_tipo_mtn'];
            $mantencionvehiculo->fecha_mtn = $_POST['fecha_mtn'];
            $mantencionvehiculo->lugar_mtn = $_POST['lugar_mtn'];
            $mantencionvehiculo->costo_mtn = $_POST['costo_mtn'];
            $mantencionvehiculo->desc_mtn_vehi = $_POST['desc_mtn_vehi'];
            
			$mantencionvehiculo->create();
            
			message("¡Nuevo mantenci&oacute;n de veh&iacute;culo registrada exitosamente!", "success");
            echo "2";
			redirect("../view/vehiculos/mantencionVehiculo/indexMtnVehiculo.php");

		}
	}

}

function doEdit()
{
	if (isset($_POST['save'])) {

		$mantencionvehiculo = new MantencionVehiculo();
        $mantencionvehiculo->patente = $_POST['patente'];
        $mantencionvehiculo->id_tipo_mtn = $_POST['id_tipo_mtn'];
        $mantencionvehiculo->fecha_mtn = $_POST['fecha_mtn'];
        $mantencionvehiculo->lugar_mtn = $_POST['lugar_mtn'];
        $mantencionvehiculo->costo_mtn = $_POST['costo_mtn'];
        $mantencionvehiculo->desc_mtn_vehi = $_POST['desc_mtn_vehi'];

        $mantencionvehiculo->update($_POST['id_mtn_vehiculo']);

        message("La mantenci&oacute;n para el vehiculo de patente [" . $_POST['patente'] . "] ha sido actualizada!", "success");
        redirect("../view/vehiculos/mantencionVehiculo/indexMtnVehiculo.php");
    }
}


function doDelete() {
    echo "Mantenci&oacute;n Vehiculo";
    $id = isset($_GET['id_mtn_vehiculo']) ? intval($_GET['id_mtn_vehiculo']) : 0;
    if ($id <= 0) {
        die("ID inválido.");
        echo "Mantenci&oacute;n Vehiculo";
    }

    $mantencionvehiculo = new MantencionVehiculo();
    $mantencionvehiculoSeleccionado = $mantencionvehiculo->single_mantencion($id);
    if ($mantencionvehiculo->delete($id)) {
        message("La mantenci&oacute;n del vehiculo de patente [" . $mantencionvehiculoSeleccionado->patente . "] ha sido eliminada!", "success");
        redirect('../view/vehiculos/mantencionVehiculo/indexMtnVehiculo.php');
    } else {
        message("La mantenci&oacute;n del vehiculo de patente [" . $mantencionvehiculoSeleccionado->patente . "] no ha podido ser eliminada!", "error");
        redirect('../view/vehiculos/mantencionVehiculo/indexMtnVehiculo.php');
    }
}

if ($_GET['action'] == "filtrar") {
    header("Content-Type: application/json");

    // Leer datos JSON enviados por AJAX
    $datos_json = file_get_contents("php://input");
    $filtros = json_decode($datos_json, true);
    
    if (!$filtros) {
        echo json_encode(["error" => "No se recibieron datos válidos"]);
        exit;
    }
    
    // Ver qué datos llegaron
    error_log("Filtros recibidos: " . print_r($filtros, true));
    
    $mantencionVehiculo = new MantencionVehiculo();
    $resultados = $mantencionVehiculo->filtrar_mantenciones($filtros);
    // Verificar la respuesta antes de enviarla
    error_log("Resultados obtenidos: " . print_r($resultados, true));
    
    echo json_encode($resultados);
}

if ($_GET['action'] == 'tipos_categoria') {

    // Recibir el JSON del cuerpo
    $json = file_get_contents('php://input');
    $params = json_decode($json, true);

    $id_cate_mtn = intval($params['id_categoria']);

    $tipoMantencion = new TipoMantencion();
    $tipos = $tipoMantencion->list_of_tipo_mantencion_categoria($id_cate_mtn);

    // Devolver el array como JSON
    header('Content-Type: application/json');
    echo json_encode($tipos);
    exit;
}

if ($_GET['action'] == 'categoria_tipo') {

    // Recibir el JSON del cuerpo
    $json = file_get_contents('php://input');
    $params = json_decode($json, true);

    $idTipoMantencion = intval($params['id_tipo_mtn']);

    $tipoMantencion = new TipoMantencion();
    $categoria = $tipoMantencion->list_of_tipo_mantencion_id($idTipoMantencion);

    header('Content-Type: application/json');
    echo json_encode($categoria);
    exit;
}
?>