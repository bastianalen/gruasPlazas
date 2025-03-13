<?php
require_once("../../../controller/initialize.php");
//checkAdmin();
  	//  if (!isset($_SESSION['user_id'])){
    //   redirect(web_root."view/admin/index.php");
    //  }

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$header=$view;
$titulo="Mantencion Recomendada";
switch ($view) {
	case 'list' :
		$content    = 'listMtnRecomendada.php';		
		break;

	case 'add' :
		$content    = 'addMtnRecomendada.php';		
		break;

	case 'edit' :
		$content    = 'editMtnRecomendada.php';		
		break;

	default :
		$content    = 'listMtnRecomendada.php';
}
require_once ("../../themes/templates.php");