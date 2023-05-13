<header>
    <nav class="container navegacion">
        <div class="logo">
            <a href="./principal.php">
                <img src="./../public/img/logo.png" alt="logo de bodega">

            </a>
        </div>
        <div>
            <ul class="indices-navegacion">
                <li class="<?php echo $_SERVER['REQUEST_URI'] == '/proyecto_integrador/views/principal.php' ? 'activo' : '' ?>">
                    <a href="/">
                        <i class="fa-solid fa-house"></i> Inicio
                    </a>
                </li>
                <li> <a href=""><i class="fa-solid fa-id-badge"></i> Contacto</a>
                </li>
                <li> <a href=""><i class="fa-solid fa-users"></i> Nosotros</a>
                </li>
                <li> <a href=""><i class="fa-solid fa-box-open"></i> Productos</a>
                </li>
                <li class="<?php echo $_SERVER['REQUEST_URI'] == '/proyecto_integrador/views/login.php' ? 'activo-btn' : '' ?>">
                    <a href="login" class="btn btn-sm btn-light text-secondary">
                        <i class="fa-solid fa-user"></i>
                    </a>
                </li>
                <li>
                    <a href="" class="btn btn-sm btn-light text-secondary">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </li>
            </ul>
        </div>

    </nav>
</header>