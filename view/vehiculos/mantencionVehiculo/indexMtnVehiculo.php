<?php
require_once("../../../controller/initialize.php");
//checkAdmin();
  	//  if (!isset($_SESSION['user_id'])){
    //   redirect(web_root."view/admin/index.php");
    //  }

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$header=$view;
$titulo="Mantenci&oacute;n Vehiculo";
switch ($view) {
	case 'list' :
		$content    = 'listMtnVehiculo.php';		
		break;

	case 'add' :
		$content    = 'addMtnVehiculo.php';		
		break;

	case 'edit' :
		$content    = 'editMtnVehiculo.php';		
		break;

	default :
		$content    = 'listMtnVehiculo.php';
}
require_once ("../../themes/templates.php");