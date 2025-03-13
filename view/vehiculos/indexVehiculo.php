<?php
require_once("../../controller/initialize.php");
//checkAdmin();
  	//  if (!isset($_SESSION['user_id'])){
    //   redirect(web_root."view/admin/index.php");
    //  }

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$header=$view;
$titulo="Vehiculos";
switch ($view) {
	case 'list' :
		$content    = 'listVehiculo.php';		
		break;

	case 'add' :
		$content    = 'addVehiculo.php';		
		break;

	case 'edit' :
		$content    = 'editVehiculo.php';		
		break;

	default :
		$content    = 'listVehiculo.php';
}
require_once ("../themes/templates.php");