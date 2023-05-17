  <header class="cabecera">
      <nav>
          <div class="menu">
              <div>
                  <button class="btn btn-sm btn-light" id="menu-hamburguesa">
                      <i class="fa-solid fa-bars"></i>
                  </button>
              </div>
              <div>
                  <a href="/">
                      <img src="<?php echo URL . '/Public/img/logo.png' ?>" class="imagen-logo" alt="Logo BodegaFast">
                  </a>
              </div>
          </div>
          <!-- <div class="contenido-busqueda">
        <input type="text" placeholder="Buscar" class="form-control form-control-sm" style="width:300px;">
      </div> -->
          <div class="informacion">
              <div class="dropdown">
                  <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="<?php echo URL . '/Public/img/avatarAdmin.png' ?>" class="imagen-icono" alt="Avatar admin">
                      <span class="nombre-usuario"><?= $data['nombres'] ?></span>
                  </button>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item text-secondary" href="#"><i class="fa-solid fa-circle-info"></i> Mi información</a></li>
                      <li><a class="dropdown-item cerrar-sesion text-secondary" href="javascript:void(0)    "><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión</a></li>
                  </ul>
              </div>
          </div>
      </nav>
  </header>
  <div class="modulos">
      <div class="img-admin">
          <div class="py-3">
              <img src="<?php echo URL . '/Public/img/avatarAdmin.png' ?>" alt="Avatar admin">
          </div>
          <span class="d-block"><?= $data['nombres'] . ' ' . $data['apellidos'] ?></span>
          <span>Administrador</span>
      </div>
      <ul class="lista-modulos">
          <li class="<?php echo $_SERVER['REQUEST_URI'] == '/intranet/inicio' ? 'activo' : '' ?>">
              <a href="/intranet/inicio">
                  <i class="fa-solid fa-house"></i>
                  <span>Inicio</span>
              </a>
          </li>
          <li class="<?php echo $_SERVER['REQUEST_URI'] == '/intranet/administrador/bodegas' ? 'activo' : '' ?>">
              <a href="/intranet/administrador/bodegas">
                  <i class="fa-solid fa-shop"></i>
                  <span>Bodegas</span>
              </a>
          </li>
          <li class="<?php echo $_SERVER['REQUEST_URI'] == '/intranet/administrador/categorias' ? 'activo' : '' ?>">
              <a href="/intranet/administrador/categorias">
                  <i class="fa-solid fa-tags"></i>
                  <span>Categoría</span>
              </a>
          </li>
          <li class="<?php echo $_SERVER['REQUEST_URI'] == '/intranet/administrador/marcas' ? 'activo' : '' ?>">
              <a href="/intranet/administrador/marcas">
                  <i class="fa-solid fa-certificate"></i>
                  <span>Marcas</span>
              </a>
          </li>
          <li>
              <a class="cerrar-sesion" href="javascript:void(0)">
                  <i class="fa-solid fa-arrow-right-from-bracket"></i>
                  <span>Cerrar sesión</span>
              </a>
          </li>
      </ul>
  </div>