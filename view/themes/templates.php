<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $titulo; ?></title>

    <?php include_once __DIR__ . '/../../controller/config.php'; 
    require_once(__DIR__."/../../controller/initialize.php");
    ?>
    <!-- Metodo 1 -->
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/styleGeneral.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/footer.css">
    
    <!-- Link para iconoss -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>

  <?php
  // admin_confirm_logged_in();
  ?>

    <body x-data="{ isCollapsed: false, activeMenu: '' }">
      <div id="wrapper">

        <!-- Barra de navegación -->
        <nav class="navbar navbar-inverse" role="navigation" style="background-color: #e1e1e1;">
          <div class="container-inter-navbar">
            <!-- Logo en barra de navegación -->
            <a class="navbar-logo flex-none-center" href="#">
                <img src="<?= BASE_URL ?>public/img/logo_gruas_plaza.png" alt="Logo LosMelipillanos">
            </a>
            <div class="navbar-items flex-none-center">
              <!-- Lista desordenada de links -->
              <ul class="navbar-menu flex-none-center">
                <!-- Link inicio -->
                <li class="nav-link flex-none-center resalto-alto">
                    <a href="<?= BASE_URL ?>index.php">Inicio</a>
                </li>
                <!-- Link para vehiculos y sus mantenciones -->
                <li class="nav-link flex-none-center resalto-alto submenu">
                  <a href="<?= BASE_URL ?>view/vehiculos/indexVehiculo.php">Vehiculos</a>
                   <!-- Submenú de vehiculos -->
                  <div class="dropdown">
                    <div class="dropdown-columns">
                      <!-- Columna 1: Opciones de Mantenciones -->
                      <div class="dropdown-column">
                        <h4>Mantenciones</h4>
                        <ul>
                          <li><a href="<?= BASE_URL ?>view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php">Mantenciones Recomendadas</a></li>
                          <li><a href="<?= BASE_URL ?>view/vehiculos/tipoMantencion/indexTipoMtn.php">Tipo de Mantenci&oacute;n</a></li>
                          <li><a href="<?= BASE_URL ?>view/vehiculos/categoriaMtn/indexCateMtn.php">Categor&iacute;a de Mantenci&oacute;n</a></li>
                        </ul>
                      </div>
                      <!-- Columna 2: Opciones de Vehículos -->
                      <div class="dropdown-column">
                        <h4>Veh&iacute;culos</h4>
                        <ul>
                          <li><a href="<?= BASE_URL ?>view/vehiculos/CategoriaVehiculo/indexCateVehiculo.php">Veh&iacute;culos</a></li>
                          <li><a href="<?= BASE_URL ?>view/vehiculos/tipoVehiculo/indexTipoVehiculo.php">Tipo Veh&iacute;culo</a></li>
                          <li><a href="<?= BASE_URL ?>view/vehiculos/mantencionVehiculo/indexMtnVehiculo.php">Mantenci&oacute;n de Veh&iacute;culo</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- Link trabajadores -->
                <li class="nav-link flex-none-center resalto-alto">
                  <a href="<?= BASE_URL ?>view/trabajadores/trabajadores.php">Trabajadores</a>
                </li>
                <!-- Link clientes -->
                <li class="nav-link flex-none-center resalto-alto">
                  <a href="<?= BASE_URL ?>view/clientes/clientes.php">Clientes</a>
                </li>
                <!-- Link trabajos -->
                <li class="nav-link flex-none-center resalto-alto">
                  <a href="<?= BASE_URL ?>view/trabajos/trabajos.php">Trabajos</a>
                </li>
                <!-- Link Finanzas -->
                <li class="nav-link flex-none-center resalto-alto">
                  <a href="<?= BASE_URL ?>view/finanzas/finanzas.php">Finanzas</a>
                </li>
              </ul>
            </div>
          </div>

          <!-- FIN BARRA DE NAVEGACION PRINCIPAL -->

          <!-- ------------------------------------------------------------------------------------------------------------------------------ -->
           
          <!-- ESTE APARTADO ES DEL MENU breadcrumb CONTENIDO EN LINKS CLIC REDIRIGE AL PANEL ADMINISTRADORES y UBICACION ACTUAL EN APARTADOS -->
          <div id="page-wrapper">
            <div class="row">
              <div class="col-lg-12" style="margin-top: 4%">
                <?php check_message(); ?>
                <?php require_once $content; ?>

              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /#page-wrapper -->
      </div>

    </body>
    <footer>
      
      <script src="<?= BASE_URL ?>public/js/header.js"></script>
    </footer>

</html>