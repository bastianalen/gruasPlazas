<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleIndex.css">
    <?php include 'view/partial/head.php'; ?>
</head>
<body>

    <?php include 'view/partial/header.php'; ?>
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
                        <a href="view/camiones/camiones.php" class="enlace-cuadro">
                            <div class="camiones-especifico">
                                <figure class="imagen">
                                    <img src="./public/img/Grua_amarilla_1.jpg" alt="Imagen de Felipe Avello">
                                </figure>
                                <figcaption class="titulo-funcion flex-center-center">
                                    <h2>Camiones</h2>
                                </figcaption>
                                <figcaption class="descripcion-funcion ">
                                    <p>Muestra la información relacionada a los camiones: </p>
                                    <ul class="lista-descripcion"> 
                                        <li>Documentación</li>
                                        <li>Mantenciones</li>
                                        <li>Reparaciones</li>
                                        <li>Repuestos</li>
                                    </ul>
                                </figcaption>
                            </div>
                        </a>
                        
                        <a href="view/trabajadores/trabajadores.php" class="enlace-cuadro">
                            <div class="camiones-especifico">
                                <figure class="imagen">
                                    <img src="./public/img/Trabajador.jpg" alt="Imagen de Romina Sáez">
                                </figure>
                                <figcaption class="titulo-funcion flex-center-center">
                                    <h2>Trabajadores</h2>
                                </figcaption>
                                <figcaption class="descripcion-funcion">
                                    <p>Muestra la información relacionada a los trabajadores: </p>
                                    <ul class="lista-descripcion"> 
                                        <li>Información personal</li>
                                        <li>Trabajos</li>
                                    </ul>
                                </figcaption>
                            </div>
                        </a>
                        <a href="view/clientes/clientes.php" class="enlace-cuadro">
                            <div class="camiones-especifico">
                                <figure class="imagen">
                                    <img src="./public/img/Cliente.jpg" alt="Imagen de Yamila Reyna">
                                </figure>
                                <figcaption class="titulo-funcion flex-center-center">
                                    <h2>Clientes</h2>
                                </figcaption>
                                <figcaption class="descripcion-funcion ">
                                    <p>Muestra la información relacionada a los clientes: </p>
                                    <ul class="lista-descripcion"> 
                                        <li>Tipo de cliente</li>
                                        <li>Historial</li>
                                    </ul>
                                </figcaption>
                            </div>
                        </a>
                        <a href="view/trabajos/trabajos.php" class="enlace-cuadro">
                            <div class="camiones-especifico">
                                <figure class="imagen">
                                    <img src="./public/img/Grua_amarilla_3.jpg" alt="Imagen de Yamila Reyna">
                                </figure>
                                <figcaption class="titulo-funcion flex-center-center">
                                    <h2>Trabajos</h2>
                                </figcaption>
                                <figcaption class="descripcion-funcion ">
                                    <p>Muestra la información relacionada a los trabajos: </p>
                                    <ul class="lista-descripcion"> 
                                        <li>Tipo de trabajos</li>
                                        <li>Historial de trabajos</li>
                                        <li>Proximos trabajos</li>
                                    </ul>
                                </figcaption>
                            </div>
                        </a>
                        <a href="view/finanzas/finanzas.php" class="enlace-cuadro">
                            <div class="camiones-especifico">
                                <figure class="imagen">
                                    <img src="./public/img/Finanzas.jpg" alt="Imagen de Yamila Reyna">
                                </figure>
                                <figcaption class="titulo-funcion flex-center-center">
                                    <h2>Finanzas</h2>
                                </figcaption>
                                <figcaption class="descripcion-funcion ">
                                    <p>Muestra la información relacionada a las finanzas: </p>
                                    <ul class="lista-descripcion"> 
                                        <li>Ingresos</li>
                                        <li>Egresos</li>
                                        <li>Mensual</li>
                                    </ul>
                                </figcaption>
                            </div>
                        </a>

                    </div>
                </div>
            </section>
        </article>
    </main>
    <!-- Inicio Footer -->
    <?php 
        // include 'view/partial/footer.php'; 
    ?>
    <!-- Fin Footer -->
</body>
</html>