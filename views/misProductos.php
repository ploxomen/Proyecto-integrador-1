<!DOCTYPE html>
<html lang="es">

<head>
    <?php include("helpers/header.php") ?>
    <?php include("helpers/headerDashboard.php") ?>
    <title>Mis productos</title>
</head>

<body>
    <?php include("helpers/dashboardBodega.php") ?>
    <main class="contenido-pagina">
        <h3 class="text-center titulo-principal-modulo mb-4">Mis productos</h3>
        <div class="contenido-tabla bg-white p-3">
            <div class="py-3">
                <h4 class="titulo-principal-modulo"><i class="fa-solid fa-caret-right"></i> Lista de productos</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>N°</th>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Categorías</th>
                            <th>Marca</th>
                            <th>Precio compra</th>
                            <th>Precio venta</th>
                            <th>Stock mínimo</th>
                            <th>Stock Actual</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Leche Gloria Azul</td>
                            <td>Lata de 100ml grande</td>
                            <td><span class="badge text-bg-primary">Lacteos</span>
                            </td>
                            <td>Gloria</td>
                            <td>S/ 3.50</td>
                            <td>S/ 4.20</td>
                            <td>2</td>
                            <td>10</td>
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