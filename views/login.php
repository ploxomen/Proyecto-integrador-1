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
                        <div class="card text-secondary" style="border-radius: 1rem; box-shadow: 2px 2px 10px #F8B602; border:none;">
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
                                                <input type="email" id="form2Example17" class="form-control form-control-lg" required />
                                            </div>

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example27"><i class="fa-solid fa-lock"></i> Contraseña</label>
                                                <input type="password" id="form2Example27" class="form-control form-control-lg" required />
                                            </div>
                                            <div class="my-3 text-end">
                                                <a class="small text-muted" href="#!">¿Olvidaste tu contraseña?</a>
                                            </div>
                                            <div class="pt-1 mb-2 text-center">
                                                <button class="btn btn-secondary btn-lg btn-block" type="submit"><i class="fa-solid fa-arrow-right-to-bracket"></i> Ingresar</button>
                                            </div>
                                        </form>
                                        <form action="" id="frmRegistro" hidden>
                                            <div class="form-outline mb-2">
                                                <label class="form-label" for="correoRegistro"><i class="fa-solid fa-envelope"></i> Correo</label>
                                                <input type="email" id="correoRegistro" class="form-control" required />
                                            </div>

                                            <div class="form-outline mb-2">
                                                <label class="form-label" for="contrasenaRegistro"><i class="fa-solid fa-lock"></i> Contraseña</label>
                                                <input type="password" id="contrasenaRegistro" class="form-control" required />
                                            </div>
                                            <div class="form-outline mb-2">
                                                <label class="form-label" for="direccionRegistro"><i class="fa-solid fa-street-view"></i> Dirección</label>
                                                <input type="text" id="direccionRegistro" class="form-control" />
                                            </div>
                                            <div class="form-outline mb-2">
                                                <label class="form-label" for="celularRegistro"><i class="fa-solid fa-mobile-screen"></i> Celular</label>
                                                <input type="text" id="celularRegistro" class="form-control" />
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