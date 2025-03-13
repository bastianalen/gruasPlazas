    <header>
        <nav class="nav flex-none-center">
            <div class="container-inter-navbar">
                <a class="navbar-logo flex-none-center" href="#">
                    <img src="<?= BASE_URL ?>public/img/logo_gruas_plaza.png" alt="Logo LosMelipillanos">
                </a>
                <div class="navbar-items flex-none-center">
                    <ul class="navbar-menu flex-none-center">
                        <li class="nav-link flex-none-center resalto-alto">
                            <a href="<?= BASE_URL ?>index.php">Inicio</a>
                        </li>
                        <li class="nav-link flex-none-center resalto-alto submenu">
                            <a href="<?= BASE_URL ?>view/vehiculos/indexVehiculo.php">Vehiculos</a>
                             <!-- Submenú -->
                            <ul class="dropdown">
                                
                            </ul>
                            <div class="dropdown">
                                <div class="dropdown-columns">
                                    <!-- Columna 1: Opciones de Mantenciones -->
                                    <div class="dropdown-column">
                                        <h4>Mantenciones</h4>
                                        <ul>
                                            <li><a href="<?= BASE_URL ?>view/vehiculos/mantencionRecomendada/indexMtnRecomendada.php?view=list">Mantenciones Recomendadas</a></li>
                                            <li><a href="<?= BASE_URL ?>view/mantenciones/addTipoMantencion.php">Tipo de Mantenci&oacute;n</a></li>
                                            <li><a href="<?= BASE_URL ?>view/mantenciones/addCategoriaMantencion.php">Categor&iacute;a de Mantenci&oacute;n</a></li>
                                        </ul>
                                    </div>

                                    <!-- Columna 2: Opciones de Vehículos -->
                                    <div class="dropdown-column">
                                        <h4>Veh&iacute;culos</h4>
                                        <ul>
                                            <li><a href="<?= BASE_URL ?>view/vehiculos/addVehiculo.php">Veh&iacute;culos</a></li>
                                            <li><a href="<?= BASE_URL ?>view/vehiculos/addTipoVehiculo.php">Tipo Veh&iacute;culo</a></li>
                                            <li><a href="<?= BASE_URL ?>view/vehiculos/addMantencionVehiculo.php">Mantenci&oacute;n de Veh&iacute;culo</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-link flex-none-center resalto-alto">
                            <a href="<?= BASE_URL ?>view/trabajadores/trabajadores.php">Trabajadores</a>
                        </li>
                        <li class="nav-link flex-none-center resalto-alto">
                            <a href="<?= BASE_URL ?>view/clientes/clientes.php">Clientes</a>
                        </li>
                        <li class="nav-link flex-none-center resalto-alto">
                            <a href="<?= BASE_URL ?>view/trabajos/trabajos.php">Trabajos</a>
                        </li>
                        <li class="nav-link flex-none-center resalto-alto">
                            <a href="<?= BASE_URL ?>view/finanzas/finanzas.php">Finanzas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>