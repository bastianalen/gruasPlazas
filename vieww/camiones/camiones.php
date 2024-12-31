<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="camiones.css">
    <?php include '../partial/head.php'; ?>
</head>
<body>

    <?php include '../partial/header.php'; ?>
    <main>
        <!-- Articulos y noticias -->
        <article class="article-inicio">
            <!-- Noticias antiguas -->
            <section class="container-seccion-camiones flex-center-none">
            <div class="container-camiones">
                    <!-- Estructura de noticias por categoría -->
                    <div class="muestra-camiones">
                        <h2>Detalle de Funcionalidades</h2>
                    </div>
                    <div class="camiones">
                        <div class="camiones-especifico" data-grua="Grua 1">
                            <figure class="imagen">
                                <img class="camion-imagen" src="<?= BASE_URL ?>public/img/Grua_amarilla_1.jpg" alt="Imagen de Felipe Avello">
                            </figure>
                            <figcaption class="titulo-camiones flex-center-center">
                                <h2>Camiones</h2>
                            </figcaption>
                            <figcaption class="descripcion-camiones ">
                                <p>Muestra la mantención con mayor urgencia: </p>
                                <ul class="lista-descripcion"> 
                                    <li class="mantencion-urgente">Filtro de aceite</li>
                                </ul>
                            </figcaption>
                        </div>
                        <div class="camiones-especifico" data-grua="Grua 2">
                            <figure class="imagen">
                                <img class="camion-imagen" src="<?= BASE_URL ?>public/img/Grua_amarilla_2.jpg" alt="Imagen de Romina Sáez">
                            </figure>
                            <figcaptcion class="titulo-camiones flex-center-center">
                                <h2>Camion 2</h2>
                            </figcaptcion>
                            <figcaption class="descripcion-camiones ">
                                <p>Muestra la mantención con mayor urgencia: </p>
                                <ul class="lista-descripcion"> 
                                    <li class="mantencion-urgente">Aceite hidraulico</li>
                                </ul>
                            </figcaption>
                        </div>
                        <div class="camiones-especifico" data-grua="Grua 3">
                            <figure class="imagen">
                                <img class="camion-imagen" src="<?= BASE_URL ?>public/img/Grua_amarilla_3.jpg" alt="Imagen de Yamila Reyna">
                            </figure>
                            <figcaption class="titulo-camiones flex-center-center">
                                <h2>Camion 3</h2>
                            </figcaption>
                            <figcaption class="descripcion-camiones ">
                                <p>Muestra la mantención con mayor urgencia: </p>
                                <ul class="lista-descripcion"> 
                                    <li class="mantencion-urgente">Aceite de motor</li>
                                </ul>
                            </figcaption>
                        </div>
                        <div class="camiones-especifico" data-grua="Grua 4">
                            <figure class="imagen">
                                <img class="camion-imagen" src="<?= BASE_URL ?>public/img/Grua_blanca_1.jpg" alt="Imagen de Yamila Reyna">
                            </figure>
                            <figcaption class="titulo-camiones flex-center-center">
                                <h2>Camion 4</h2>
                            </figcaption>
                            <figcaption class="descripcion-camiones ">
                                <p>Muestra la mantención con mayor urgencia: </p>
                                <ul class="lista-descripcion"> 
                                    <li class="mantencion-urgente">Neumatico trasero</li>
                                </ul>
                            </figcaption>
                        </div>
                        <div class="camiones-especifico" data-grua="Grua 5">
                            <figure class="imagen">
                                <img class="camion-imagen" src="<?= BASE_URL ?>public/img/Grua_amarilla_1.jpg" alt="Imagen de Yamila Reyna">
                            </figure>
                            <figcaption class="titulo-camiones flex-center-center">
                                <h2>Camion 5</h2>
                            </figcaption>
                            <figcaption class="descripcion-camiones ">
                                <p>Muestra la mantención con mayor urgencia: </p>
                                <ul class="lista-descripcion"> 
                                    <li class="mantencion-urgente">Filtro de Aire</li>
                                </ul>
                            </figcaption>
                        </div>
                        <!-- Modal -->
                        <div id="modal-camiones" class="modal-camiones oculto">
                            <div class="contenido-modal">
                                <span class="cerrar-modal">&times;</span>
                                <figure class="modal-figure">
                                    <img id="modal-imagen" src="" alt="Imagen del cuadro seleccionado">
                                </figure>
                                <h2 id="modal-titulo"></h2>
                                <div class="mantenciones">
                                    <h3>Mantenciones</h3>
                                    <table class="informacion-mantenciones">
                                        <tr>
                                            <th>tipo</th>
                                            <th>Fecha</th>
                                            <th>Descripción</th>
                                            <th>Estado</th>
                                            <th>Más Información</th>
                                        </tr>
                                        <tr>
                                            <td>Cambio de neumaticos</td>
                                            <td>12/05/2024</td>
                                            <td>renovación completa</td>
                                            <td class="al-dia">Al día</td>
                                            <td>
                                                <span class="icono-redireccion" data-camion="1" data-info="neumaticos">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cambio de aceite motor</td>
                                            <td>08/06/2022</td>
                                            <td>Cambio de aceite motor 2021</td>
                                            <td class="atrasado">atrasado</td>
                                            <td>
                                                <span class="icono-redireccion" data-camion="1" data-info="aceite-motor">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cambio de filtro aceite</td>
                                            <td>08/06/2022</td>
                                            <td>Cambio de filtro aceite nro: 12</td>
                                            <td class="en-progreso">En progreso</td>
                                            <td>
                                                <span class="icono-redireccion" data-camion="1" data-info="filtro-aceite">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cambio de Aceite Hidraulico</td>
                                            <td>22/08/2022</td>
                                            <td>Cambio de aceite hidraulico</td>
                                            <td class="completado">Completado</td>
                                            <td>
                                                <span class="icono-redireccion" data-camion="1" data-info="aceite-hidraulico">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cambio de agua</td>
                                            <td>22/08/2022</td>
                                            <td>Cambio de aceite hidraulico</td>
                                            <td class="cancelado">Cancelado</td>
                                            <td>
                                                <span class="icono-redireccion" data-camion="1" data-info="agua">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </span>
                                            </td>
                                        </tr>
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
        include '../partial/footer.php'; 
        ?>
        <script src="./camiones.js"></script>
    </footer>
        <!-- Fin Footer -->
</body>
</html>