<?php
require_once("../../../controller/initialize.php");
//checkAdmin();
  	//  if (!isset($_SESSION['user_id'])){
    //   redirect(web_root."view/admin/index.php");
    //  }

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$header=$view;
$titulo="Tipo de Mantencion";
switch ($view) {
	case 'list' :
		$content    = 'listTipoMtn.php';		
		break;

	case 'add' :
		$content    = 'addTipoMtn.php';		
		break;

	case 'edit' :
		$content    = 'editTipoMtn.php';		
		break;

	default :
		$content    = 'listTipoMtn.php';
}
require_once ("../../themes/templates.php");