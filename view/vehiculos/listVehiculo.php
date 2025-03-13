<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
    //include '../partial/head.php'; 
    ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/vehiculos.css">
</head>
<body>

    <?php //include '../partial/header.php'; ?>
    <main>
        <!-- Articulos y noticias -->
        <article class="article-inicio">
            <!-- Noticias antiguas -->
            <section class="container-seccion-vehiculos">
                <div class="container-vehiculos">
                    <!-- Estructura de noticias por categoría -->
                    <div class="titulo-botones-vehiculos">
                        <h2>Vehiculos</h2>
                        <a href="indexVehiculo.php?view=add" class="btn-accion añadir">Añadir Vehiculo</a>
                    </div>
                    <div class="vehiculos">
                        <?php 
                            $vehiculo = new Vehiculo();
                            $vehiculos = $vehiculo->list_of_vehiculo();

                            // Se debe realizar una formula para obtener el cambio con mayor urgencia del vehiculo
                            $cambioUrgente = "Aceite de motor";
                            $classCambio = "mantencion-urgente";

                            foreach ($vehiculos as $vehiculo) {
                                echo '<div class="vehiculos-especifico" data-patente="'. $vehiculo['patente'] .'" data-grua="'. $vehiculo['id_vehiculo'] .'" data-nombre="'. $vehiculo["nombre"] .'">';
                                echo '<figure class="imagen">
                                    <img class="camion-imagen" src="'. BASE_URL .'public/img/img_vehiculos/' . $vehiculo["imagen_vehi"] . '" alt="Imagen de '.$vehiculo["nombre"].'">
                                    <a href="indexVehiculo.php?view=edit&patente='.$vehiculo['patente'].'" class="btn-accion btn-actualizar"> Actualizar Información</a>
                                    <a href="../../controller/controllerVehiculo.php?action=delete&id_vehiculo='.$vehiculo['id_vehiculo'].'" class="btn-accion btn-eliminar"> Eliminar vehiculo</a>
                                </figure>';
                                echo '<figcaption class="titulo-vehiculos flex-center-center">
                                    <h2>'.$vehiculo["nombre"].'</h2>
                                </figcaption>';
                                echo '<figcaption class="descripcion-vehiculos ">
                                    <p>Muestra la mantención con mayor urgencia: </p>
                                    <ul class="lista-descripcion"> 
                                        <li class="'.$classCambio.'">'.$cambioUrgente.'</li>
                                    </ul>
                                </figcaption>';
                                echo '</div>';
                            }
                        ?>
                        <!-- Modal -->
                        <div id="modal-vehiculos" class="modal-vehiculos oculto">
                            <div class="contenido-modal">
                                <span class="cerrar-modal">&times;</span>
                                <figure class="modal-figure">
                                    <img id="modal-imagen" src="" alt="Imagen del cuadro seleccionado">
                                </figure>
                                <h2 id="modal-titulo"></h2>
                                <div class="mantenciones">
                                    <h3>Mantenciones</h3>
                                    <table class="informacion-mantenciones">
                                        <!-- Información extraida desde js y funcionalidades con php -->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </main>
    <!-- Inicio Footer -->
    <footer>

         <?php 
        //include '../partial/footer.php'; 
        ?>
        <script src="<?= BASE_URL ?>public/js/vehiculos.js"></script>
    </footer>
        <!-- Fin Footer -->
</body>
</html>