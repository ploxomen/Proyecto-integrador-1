<!DOCTYPE html>
<html lang="es">

<head>
    <?php include("helpers/header.php") ?>
    <link rel="stylesheet" href="./../public/css/productosCliente.css">
    <script src="./../public/js/productosCliente.js"></script>
    <title>Inicio</title>
</head>

<body>
    <?php include("helpers/headerIndex.php"); ?>
    <main>
        <h2 class="text-center titulo-principal-modulo my-4">!ENCUENTRA TUS PRODUCTOS AQUI!</h2>
        <div class="container d-flex" style="gap:10px">
            <section class="filtros">
                <form action="" class="mb-5">
                    <div class="categorias my-4">
                        <h5 class="titulo-principal-modulo">Categorías</h5>
                        <div class="card" style="width: 18rem;">
                            <ul class="list-group list-group-flush">
                                <?php
                                    foreach ($categorias as $categoria) {
                                ?>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="<?php echo 'categoriaId' . $categoria['id'] ?>">
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
                        <div class="card" style="width: 18rem;">
                            <ul class="list-group list-group-flush">
                                <?php
                                    foreach ($marcas as $marca) {
                                ?>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="<?php echo 'categoriaId' . $marca['id'] ?>">
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
            <section class="productos"></section>
        </div>
    </main>
    <?php include("helpers/footerIndex.php"); ?>

</body>

</html>