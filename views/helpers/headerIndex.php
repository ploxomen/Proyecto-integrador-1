<header>
    <nav class="container navegacion">
        <div class="logo">
            <a href="./principal.php">
                <img src="./../public/img/logo.png" alt="logo de bodega">

            </a>
        </div>
        <div>
            <ul class="indices-navegacion">
                <li class="<?php echo $_SERVER['REQUEST_URI'] == '/' ? 'activo' : '' ?>">
                    <a href="/">
                        <i class="fa-solid fa-house"></i> Inicio
                    </a>
                </li>
                <li> <a href=""><i class="fa-solid fa-users"></i> Nosotros</a>
                </li>
                <li class="<?php echo $_SERVER['REQUEST_URI'] == '/listar/productos' ? 'activo' : '' ?>"> <a href="<?php echo URL . '/listar/productos' ?>" class=""><i class="fa-solid fa-box-open"></i> Productos</a>
                </li>
                <li class="<?php echo $_SERVER['REQUEST_URI'] == '/login' ? 'activo-btn' : '' ?>">
                    <?php
                    if (isset($data) && isset($data['iniciales'])) {
                    ?>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-login-access dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="nombre-usuario"><?= $data['iniciales'] ?></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-secondary" href="#"><i class="fa-solid fa-circle-info"></i> Mi información</a></li>
                                <li><a id="btn-cerrar-sesion" class="dropdown-item text-secondary" href="javascript:void(0)"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión</a></li>
                            </ul>
                        </div>
                    <?php
                    } else {
                    ?>
                        <a href="<?php echo URL . '/login' ?>" class="btn btn-sm btn-light text-secondary">
                            <i class='fa-solid fa-user'></i>
                        </a>
                    <?php
                    }
                    ?>
                    </a>
                </li>
                <li class="<?php echo $_SERVER['REQUEST_URI'] == '/carrito/compras' ? 'activo-btn' : '' ?>">
                    <a href="<?php echo URL . '/carrito/compras' ?>" class="btn btn-sm btn-light text-secondary position-relative <?php echo isset($_COOKIE['carrito_compras']) ? 'badge-notification' : ''?>" id="btnCarritoCompras" data-info="<?php echo isset($_COOKIE['carrito_compras']) ? count(json_decode($_COOKIE['carrito_compras'],true)) : ''?>">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <script>
        const btnCerrarSesion = document.querySelector("#btn-cerrar-sesion");
        if(btnCerrarSesion){
            btnCerrarSesion.addEventListener("click",async e => {
                const alertaSweet = await (new Helper()).sweetAlertConfirm(null, "¿Deseas cerrar sesión?","Aceptar");
                if (alertaSweet.isConfirmed) {
                    window.location.href = window.origin + "/usuario/cerrar-sesion";
                }
            });
        }
        
    </script>
</header>