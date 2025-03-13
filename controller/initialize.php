<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
// HOST
// defined('SITE_ROOT') ? null : define('SITE_ROOT', '/home3/cpa101887/public_html');
// FIN HOST

//  Local
defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'gruasplazas');
// Fin local



defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'controller');
defined('LIB_PATH_MODEL') ? null : define ('LIB_PATH_MODEL',SITE_ROOT.DS.'model');

//load the database configuration first.
require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."function.php");
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH_MODEL.DS."accounts.php");
// Vehiculo
require_once(LIB_PATH_MODEL.DS."tipovehiculo.php");
require_once(LIB_PATH_MODEL.DS."vehiculo.php");
// Mantenciones
require_once(LIB_PATH_MODEL.DS."mtnvehiculo.php");
require_once(LIB_PATH_MODEL.DS."mtnrecomendada.php");
require_once(LIB_PATH_MODEL.DS."categoriamtn.php");
require_once(LIB_PATH_MODEL.DS."tipomtn.php");