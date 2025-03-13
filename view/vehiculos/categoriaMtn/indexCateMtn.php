<?php
require_once("../../../controller/initialize.php");
//checkAdmin();
  	//  if (!isset($_SESSION['user_id'])){
    //   redirect(web_root."view/admin/index.php");
    //  }

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$header=$view;
$titulo="Categor&iacute;a de Mantenci&oacute;n";
switch ($view) {
	case 'list' :
		$content    = 'listCateMtn.php';		
		break;

	case 'add' :
		$content    = 'addCateMtn.php';		
		break;

	case 'edit' :
		$content    = 'editCateMtn.php';		
		break;

	default :
		$content    = 'listCateMtn.php';
}
require_once ("../../themes/templates.php");