<?php
require_once("../../../controller/initialize.php");
//checkAdmin();
  	//  if (!isset($_SESSION['user_id'])){
    //   redirect(web_root."view/admin/index.php");
    //  }

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$header=$view;
$titulo="Tipo de Vehiculo";
switch ($view) {
	case 'list' :
		$content    = 'listTipoVehiculo.php';		
		break;

	case 'add' :
		$content    = 'addTipoVehiculo.php';		
		break;

	case 'edit' :
		$content    = 'editTipoVehiculo.php';		
		break;

	default :
		$content    = 'listTipoVehiculo.php';
}
require_once ("../../themes/templates.php");