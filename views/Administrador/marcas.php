<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDashboard.php"); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDatatable.php"); ?>
    <title>Marcas de productos</title>
</head>

<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/dashboard.php") ?>
    <main class="contenido-pagina">
        <h3 class="text-center titulo-principal-modulo mb-4">Marcas de productos</h3>
        <div class="bg-white p-3 mb-5">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="">Buscar</label>
                    <input type="text" class="form-control form-control-sm">
                </div>
                <div class="col-12 col-md-6 col-lg-8 text-end">
                    <button class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Agregar Marca
                    </button>
                </div>
            </div>
        </div>
        <div class="contenido-tabla bg-white p-3">
            <div class="py-3">
                <h4 class="titulo-principal-modulo"><i class="fa-solid fa-caret-right"></i> Lista de marcas</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>N°</th>
                            <th>Nombre Marca</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Gloria</td>
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
</body>

</html>