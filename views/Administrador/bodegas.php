<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDashboard.php"); ?>
    <title>Categoría de productos</title>
</head>

<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/dashboard.php") ?>
    <main class="contenido-pagina">
        <h3 class="text-center titulo-principal-modulo mb-4">Bodegas</h3>
        <div class="bg-white p-3 mb-5">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="">Buscar</label>
                    <input type="text" class="form-control form-control-sm">
                </div>
                <div class="col-12 col-md-6 col-lg-8 text-end">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bodegaModal">
                        <i class="fa-solid fa-plus"></i>
                        Agregar Bodega
                    </button>
                </div>
            </div>
        </div>
        <div class="contenido-tabla bg-white p-3">
            <div class="py-3">
                <h4 class="titulo-principal-modulo"><i class="fa-solid fa-caret-right"></i> Lista de bodegas</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>N°</th>
                            <th>RUC</th>
                            <th>Bodega</th>
                            <th>Direccion</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>20145125451</td>
                            <td>Bodega Lucero</td>
                            <td>Av. San Juan 5120 - Los Olivos</td>
                            <td>5484888</td>
                            <td>987845123</td>
                            <td>bodegalucero@gmail.com</td>
                            <td>
                                <div class="d-flex" style="gap:10px">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div aria-label="Paginacion categorias" class="d-flex justify-content-end">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </main>
    <div class="modal fade" id="bodegaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Bodega</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" novalidate>
                        <div class="col-md-6 col-12">
                            <label for="validationCustom01" class="form-label">RUC</label>
                            <input type="text" class="form-control" id="validationCustom01">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="validationCustom02" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="validationCustom02" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>

                        </div>
                        <div class="col-12">
                            <label for="validationCustomUsername" class="form-label">Correo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend">
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="validationCustom03" class="form-label">Direccion</label>
                            <input type="text" class="form-control" id="validationCustom03" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="validationCustom05" class="form-label">Localización</label>
                            <input type="text" class="form-control" id="validationCustom05" required>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="validationCustom05" class="form-label">Contraseña</label>
                            <input type="text" class="form-control" id="validationCustom05" disabled readonly>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="validationCustom03" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="validationCustom03">
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="validationCustom03" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="validationCustom03" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="validationCustom05" class="form-label">DNI Propietario</label>
                            <input type="text" class="form-control" id="validationCustom05" required>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="validationCustom05" class="form-label">Nombre Propietario</label>
                            <input type="text" class="form-control" id="validationCustom05" required>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck">
                                <label class="form-check-label" for="invalidCheck">
                                    Estoy de acurdo con las condiciones
                                </label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>