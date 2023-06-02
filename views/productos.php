<!-- AUTOR: JEAN PIER CARRASCO -->
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluimos los headers definidos en otra carpeta -->
    <?php include("helpers/header.php") ?>
    <link rel="stylesheet" href="./../public/css/productosCliente.css">
    <script src="./../public/js/productosCliente.js"></script>
    <title>Lista de productos</title>
</head>

<body>
    <!-- Incluimos la cabecera -->
    <?php include("helpers/headerIndex.php"); ?>
    <main class="contenedor-productos">
        <h2 class="text-center titulo-principal-modulo my-4">!ENCUENTRA TUS PRODUCTOS AQUI!</h2>
        <div class="container d-lg-flex" style="gap:30px">
            <section class="filtros" style="width: 500px;">
                <form id="filtosBusqueda" class="mb-5">
                    <div class="categorias my-4">
                        <h5 class="titulo-principal-modulo">Categorías</h5>
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <!-- Recorremos las categorias -->
                                <?php
                                    foreach ($categorias as $categoria) {
                                ?>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div class="custom-control custom-checkbox">
                                            <!-- Concatenamos con el html para que sea dinamico -->
                                            <input type="checkbox" name="categorias[]" class="custom-control-input" value="<?php echo $categoria['id'] ?>" id="<?php echo 'categoriaId' . $categoria['id'] ?>">
                                            <label class="custom-control-label" for="<?php echo 'categoriaId' . $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></label>
                                        </div>
                                        <span><?php echo $categoria['numeroProductos'] ?></span>
                                    </div>
                                    
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="marcas my-4">
                        <h5 class="titulo-principal-modulo">Marcas</h5>
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <!-- Recorremos las marcas -->
                                <?php
                                    foreach ($marcas as $marca) {
                                ?>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div class="custom-control custom-checkbox">
                                            <!-- Concatenamos con el html para que sea dinamico -->
                                            <input type="checkbox" name="marcas[]" class="custom-control-input" value="<?php echo $marca['id'] ?>" id="<?php echo 'categoriaId' . $marca['id'] ?>">
                                            <label class="custom-control-label" for="<?php echo 'categoriaId' . $marca['id'] ?>"><?php echo $marca['marcas'] ?></label>
                                        </div>
                                        <span><?php echo $marca['numeroProductos'] ?></span>
                                    </div>
                                    
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </form>
                
            </section>
            <section class="productos w-100">
                <div class="d-flex mb-4" style="gap:20px;">
                    <div class="input-group w-75">
                        <div class="input-group-prepend">
                            <div class="input-group-text py-3">
                                <i class="fas fa-search text-secondary"></i>
                            </div>
                        </div>
                        <input type="search" id="txtNombreProducto" class="form-control" maxlength="255" placeholder="Buscar el producto">
                    </div>
                    <div class="input-group w-25">
                        <div class="input-group-prepend">
                            <div class="input-group-text py-3">
                                <i class="fas fa-sort-amount-down text-secondary"></i>
                            </div>
                        </div>
                        <select id="cbOrdenProducto" class="form-control form-control-sm">
                            <optgroup label="Nombre de producto">
                                <option value="nombre-asc" selected>De A - Z</option>
                                <option value="nombre-desc">De Z - A</option>
                            </optgroup>
                            <optgroup label="Precio">
                                <option value="precio-menor">De menor a mayor</option>
                                <option value="precio-mayor">De mayor a menor</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <h5 class="titulo-principal-modulo mb-3">
                        <i class="fas fa-caret-right"></i>
                        Lista de productos
                    </h5>
                    <div class="lista-productos mb-5">
                        <div class="otros">
                            <div id="cargandoProductos" class="text-center" hidden>
                                <i class="fas fa-spinner fa-spin icono-excepcion"></i>
                                <span class="d-block p-3 text-secondary">Cargando productos por favor espere</span>
                            </div>
                            <div id="productoVacio" class="text-center" hidden>
                                <i class="far fa-sad-tear icono-excepcion"></i>
                                <span class="d-block p-3 text-secondary">No se contraron productos</span>
                            </div>
                        </div>
                        <div class="productos d-flex justify-content-center flex-wrap" style="gap:20px" id="contendorProductos"></div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- Incluimos el pie de pagina -->
    <?php include("helpers/footerIndex.php"); ?>

</body>

</html>