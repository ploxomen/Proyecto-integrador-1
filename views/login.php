<!DOCTYPE html>
<html lang="es">

<head>
    <?php include("helpers/header.php") ?>
    <link rel="stylesheet" href="./../public/css/login.css">
    <script src="./../public/js/login.js"></script>
    <title>Iniciar sesión</title>
</head>

<body>
    <?php include("helpers/headerIndex.php"); ?>
    <main>

        <section>
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col col-xl-10">
                        <div class="text-secondary">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-flex justify-content-center align-items-center">
                                    <div class="contenido text-center">
                                        <div class="py-5 px-4">
                                            <strong>Comprar nunca fue tan fácil con <span style="color:var(--color-principal);">BodegaFast</span></strong>
                                        </div>
                                        <img src="./../public/img/img-login.svg" alt="login form" class="img-fluid" width="300px" />
                                        <div class="py-5 px-4">
                                            <strong>Los mejores productos de las bodegas en la puerta de tu casa</strong>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5">
                                        <div class="d-flex align-items-center justify-content-center mb-3 pb-1">
                                            <img src="./../public/img/logo.png" alt="Mi logo" srcset="./../public/img/logo.png" width="150px">
                                        </div>

                                        <div class="d-flex flex-wrap my-4">
                                            <button class="btn-login activo-login" data-form="#frmLogin" data-type="login">Iniciar sesión</button>
                                            <button class="btn-login" data-form="#frmRegistro" data-type="registro">Registrate</button>
                                        </div>
                                        <form action="" id="frmLogin">
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17"><i class="fa-solid fa-user"></i> Usuario</label>
                                                <input type="email" name="correo" id="form2Example17" class="form-control form-control-lg" value="bodegalucero@gmail.com" required />
                                            </div>

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example27"><i class="fa-solid fa-lock"></i> Contraseña</label>
                                                <input type="password" name="contrasena" id="form2Example27" class="form-control form-control-lg" required />
                                            </div>
                                            <div class="my-3 text-end">
                                                <a class="small text-muted" href="#!">¿Olvidaste tu contraseña?</a>
                                            </div>
                                            <div class="pt-1 mb-4 text-center">
                                                <button class="btn btn-secondary btn-lg btn-block" type="submit"><i class="fa-solid fa-arrow-right-to-bracket"></i> Ingresar</button>
                                            </div>
                                        </form>
                                        <form id="frmRegistro" class="row" hidden>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label class="form-label" for="nombresRegistro"><i class="fa-solid fa-user"></i> Nombres</label>
                                                <input type="text" name="nombres" id="nombresRegistro" class="form-control form-control-sm" required />
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label class="form-label" for="apellidosRegistro"><i class="fa-solid fa-user-tie"></i> Apellidos</label>
                                                <input type="text" name="apellidos" id="apellidosRegistro" class="form-control form-control-sm" required />
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label class="form-label" for="correoRegistro"><i class="fa-solid fa-envelope"></i> Correo</label>
                                                <input type="email" name="correo" id="correoRegistro" class="form-control form-control-sm" required />
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label class="form-label" for="contrasenaRegistro"><i class="fa-solid fa-lock"></i> Contraseña</label>
                                                <input type="password" name="contrasena" id="contrasenaRegistro" class="form-control form-control-sm" required />
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label class="form-label" for="correoRegistro"><i class="fas fa-mobile-alt"></i> Celular</label>
                                                <input type="tel" name="celular" id="correoRegistro" class="form-control form-control-sm" />
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label class="form-label" for="correoRegistro"><i class="fas fa-street-view"></i> Dirección</label>
                                                <input type="text" name="direccion" id="correoRegistro" class="form-control form-control-sm" />
                                            </div>
                                            <div class="pt-1 mb-2 text-center">
                                                <button class="btn btn-secondary btn-lg btn-block" type="submit"><i class="fa-regular fa-floppy-disk"></i> Registrase</button>
                                            </div>
                                        </form>
                                        <a href="#!" class="small text-muted">Terminos de uso</a>
                                        <a href="#!" class="small text-muted">Politicas de privacidad</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include("helpers/footerIndex.php"); ?>

</body>

</html>