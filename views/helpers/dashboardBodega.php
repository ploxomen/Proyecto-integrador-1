  <header class="cabecera">
      <nav>
          <div class="menu">
              <div>
                  <button class="btn btn-sm btn-light" id="menu-hamburguesa">
                      <i class="fa-solid fa-bars"></i>
                  </button>
              </div>
              <div>
                  <a href="./principal.php">
                      <img src="./../public/img/logo.png" class="imagen-logo" alt="Logo BodegaFast">
                  </a>
              </div>
          </div>
          <!-- <div class="contenido-busqueda">
        <input type="text" placeholder="Buscar" class="form-control form-control-sm" style="width:300px;">
      </div> -->
          <div class="informacion">
              <div class="dropdown">
                  <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="./../public/img/avatarBodega.png" class="imagen-icono" alt="Avatar bodega">
                      <span class="nombre-usuario">Bodega Lucero</span>
                  </button>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item text-secondary" href="#"><i class="fa-solid fa-circle-info"></i> Mi información</a></li>
                      <li><a class="dropdown-item text-secondary" href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión</a></li>
                  </ul>
              </div>
          </div>
      </nav>
  </header>
  <div class="modulos">
      <div class="img-admin">
          <div class="py-3">
              <img src="./../public/img/avatarBodega.png" alt="Avatar bodega">
          </div>
          <span>Bodega Lucero</span>
      </div>
      <ul class="lista-modulos">
          <li>
              <a href="">
                  <i class="fa-solid fa-house"></i>
                  <span>Inicio</span>
              </a>
          </li>
          <li class="<?php echo $_SERVER['REQUEST_URI'] == '/proyecto_integrador/views/agregarProductos.php' ? 'activo' : '' ?>">
              <a href="./agregarProductos.php">
                  <i class="fa-solid fa-shop"></i>
                  <span>Agregar Productos</span>
              </a>
          </li>
          <li class="<?php echo $_SERVER['REQUEST_URI'] == '/proyecto_integrador/views/misProductos.php' ? 'activo' : '' ?>">
              <a href="./misProductos.php">
                  <i class="fa-solid fa-tags"></i>
                  <span>Mis Productos</span>
              </a>
          </li>
          <li>
              <a href="">
                  <i class="fa-solid fa-arrow-right-from-bracket"></i>
                  <span>Cerrar sesión</span>
              </a>
          </li>
      </ul>
  </div>