<section class="P-2">
    <div class="row mb-5 filtros-cabecera">
        <h4 class="col-12 col-lg-6 col-xl-7 titulo-principal-modulo">
            <i class="fa-solid fa-caret-right"></i> Parametros de entrada
        </h4>
        <div class="col-6 col-lg-3 col-xl-2">
            <label for="txtFechaInicio">Fecha Inicio</label>
            <input type="date" class="form-control filtro-aplicar" value="<?= date('Y-m-d', strtotime("-90 days", strtotime(date('Y-m-d')))) ?>" id="txtFechaInicio">
        </div>
        <div class="col-6 col-lg-3 col-xl-2">
            <label for="txtFechaFin">Fecha Fin</label>
            <input type="date" id="txtFechaFin" class="form-control filtro-aplicar" value="<?= date('Y-m-d') ?>">
        </div>
        <div class="col-6 col-lg-3 col-xl-1">
            <button type="button" class="btn btn-sm btn-danger" title="Imprimir" id="btnImprimirPdf"><i class="fas fa-print"></i></button>
        </div>
    </div>
    <div class="row">
        <div class="graficos-informes mb-3 col-12 col-lg-6">
            <div class="border p-2 bg-white">
                <h4 class="text-center titulo-principal-modulo">Productos vendidos</h4>
                <div class="p-3">
                <canvas id="productosVendidos"></canvas>
                </div>
            </div>
        </div>
        <div class="graficos-informes mb-3 col-12 col-lg-6">
            <div class="border p-2 bg-white">
                <h4 class="text-center titulo-principal-modulo">Ranking de bodegas</h4>
                <div class="response-table p-3">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>NRO</th>
                            <th>NOMBRE</th>
                            <th>MONTO</th>
                        </tr>
                    </thead>
                    <tbody id="tablaRankign">
                        <tr>
                            <td>1</td>
                            <td>BODEGA LUCERO</td>
                            <td>S/ 1500.00</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>BODEGA SAN PEDRO</td>
                            <td>S/ 1200.00</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>BODEGA LOS ALISOS</td>
                            <td>S/ 1110.00</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>BODEGA MARIA</td>
                            <td>S/ 950.00</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>BODEGA PEREZ MENDOZA</td>
                            <td>S/ 800.00</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                
            </div>
        </div>
        <div class="graficos-informes mb-3 col-12 col-lg-6">
            <div class="border p-2 bg-white">
                <h4 class="text-center titulo-principal-modulo">Ventas por categoría</h4>
                <div class="m-auto" style="position:relative;max-width: 400px;">
                <canvas id="ventasPorCategoria"></canvas>
                </div>
                
            </div>
        </div>
        <div class="graficos-informes mb-3 col-12 col-lg-6">
            <div class="border p-2 bg-white">
                <h4 class="text-center titulo-principal-modulo">Comparación de ventas</h4>
                <div class="p-2">
                <canvas id="compraracionVentas"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>