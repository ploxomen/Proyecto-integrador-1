<!DOCTYPE html>
<html lang="es">

<head>
    <?php include("helpers/header.php") ?>
    <link rel="stylesheet" href="./../public/css/principal.css">
    <script src="./../public/js/principal.js"></script>
    <title>Inicio</title>
</head>

<body>
    <?php include("helpers/headerIndex.php"); ?>
    <main>
        <div class="baner" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff">
            <div class="swiper" id="banerPrincipal">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="./../public/img/baner1.jpg" alt="">
                        <div class="container h-100" style="position: relative;">
                            <div class="contenido-escrito">
                                <h3 class="titulo">BodegaFast</h3>
                                <p>!Bienvenido a BodegaFast!<br>Aquí encontraras tus productos de primera necesidad y mucho más</p>
                            </div>
                        </div>

                    </div>
                    <div class="swiper-slide">
                        <img src="./../public/img/baner2.jpg" alt="">
                        <div class="container h-100" style="position: relative;">
                            <div class="contenido-escrito">
                                <h3 class="titulo">¿Cansado de no encontrar lo que buscas?</h3>
                                <p>Tus productos en la puerta de tu casa en cuestión de mínutos y con una gran variedad de métodos de pago</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="./../public/img/baner3.jpg" alt="">
                        <div class="container h-100" style="position: relative;">
                            <div class="contenido-escrito">
                                <h3 class="titulo">Variedad de bodegas</h3>
                                <p>Contamos con una gran cantidad de bodegas asociadas en Lima Norte</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="container py-3">
            <h3 class="titulo-principal py-3">Categorías</h3>
            <div class="categorias m-auto">
                <div class="lista-categorias">
                    <?php
                    foreach ($listaCategorias as $categoria) {
                    ?>
                        <div class="categoria">
                            <a href="">
                                <img src="./../public/img/categorias/<?php echo mb_strtolower($categoria['nombreCategoria'],"UTF-8") ?>.png" alt="">
                                <span><?= $categoria['nombreCategoria'] ?></span>
                            </a>

                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="productos py-3">
                <h3 class="titulo-principal py-3">Productos populares</h3>
                <div class="lista-productos">
                    <div style="--swiper-navigation-color: var(--color-principal); --swiper-pagination-color: var(--color-principal);--swiper-navigation-size: 30px;">
                        <div class="swiper" id="productosVendidos">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="p-3 producto">
                                        <img src="./../public/img/productos/apanado-sanfernando.jpg" alt="">
                                        <div class="py-2">
                                            <span class="titulo-producto">Milanesa</span>
                                            <span class="titulo-precio">S/ 15.00</span>
                                            <button class="btn btn-sm btn-danger"> <i class="fa-solid fa-cart-shopping"></i> Agregar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="p-3 producto">
                                        <img src="./../public/img/productos/apanado-sanfernando.jpg" alt="">
                                        <div class="py-2">
                                            <span class="titulo-producto">Milanesa</span>
                                            <span class="titulo-precio">S/ 15.00</span>
                                            <button class="btn btn-sm btn-danger"> <i class="fa-solid fa-cart-shopping"></i> Agregar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="p-3 producto">
                                        <img src="./../public/img/productos/apanado-sanfernando.jpg" alt="">
                                        <div class="py-2">
                                            <span class="titulo-producto">Milanesa</span>
                                            <span class="titulo-precio">S/ 15.00</span>
                                            <button class="btn btn-sm btn-danger"> <i class="fa-solid fa-cart-shopping"></i> Agregar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="p-3 producto">
                                        <img src="./../public/img/productos/apanado-sanfernando.jpg" alt="">
                                        <div class="py-2">
                                            <span class="titulo-producto">Milanesa</span>
                                            <span class="titulo-precio">S/ 15.00</span>
                                            <button class="btn btn-sm btn-danger"> <i class="fa-solid fa-cart-shopping"></i> Agregar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="p-3 producto">
                                        <img src="./../public/img/productos/apanado-sanfernando.jpg" alt="">
                                        <div class="py-2">
                                            <span class="titulo-producto">Milanesa</span>
                                            <span class="titulo-precio">S/ 15.00</span>
                                            <button class="btn btn-sm btn-danger"> <i class="fa-solid fa-cart-shopping"></i> Agregar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="p-3 producto">
                                        <img src="./../public/img/productos/apanado-sanfernando.jpg" alt="">
                                        <div class="py-2">
                                            <span class="titulo-producto">Milanesa</span>
                                            <span class="titulo-precio">S/ 15.00</span>
                                            <button class="btn btn-sm btn-danger"> <i class="fa-solid fa-cart-shopping"></i> Agregar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="p-3 producto">
                                        <img src="./../public/img/productos/apanado-sanfernando.jpg" alt="">
                                        <div class="py-2">
                                            <span class="titulo-producto">Milanesa</span>
                                            <span class="titulo-precio">S/ 15.00</span>
                                            <button class="btn btn-sm btn-danger"> <i class="fa-solid fa-cart-shopping"></i> Agregar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php include("helpers/footerIndex.php"); ?>

</body>

</html>