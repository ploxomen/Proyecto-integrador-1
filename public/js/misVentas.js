function loadPage() {
    let helper = new Helper();
    const txtFechaFin = document.querySelector("#txtFechaFin");
    const txtFechaInicio = document.querySelector("#txtFechaInicio");

    const configVentas = {
        ...helper.configuracionDataTable,
        "ajax": {
            "url": helper.urlVentasBodega,
            "method" : "POST",
            "data": function ( d ) {
                d.accion = 'ver-ventas';
                d.ffin = txtFechaFin.value;
                d.finicio = txtFechaInicio.value;
            }
        },
        columns: [
            {
                data: 'nroVenta'
            },
            {
                data: 'fecha'
            },
            {
                data: 'nombresCliente'
            },
            {
                data: 'celular'
            },
            {
                data: 'direccion'
            },
            {
                data: 'nroProductos'
            },
            {
                data: 'cantidadProductos'
            },
            {
                data: 'subtotal',
                render : function(data){
                    return helper.resetearMoneda(data);
                }
            },
            {
                data: 'igv',
                render : function(data){
                    return helper.resetearMoneda(data);
                }
            },
            {
                data: 'total',
                render : function(data){
                    return helper.resetearMoneda(data);
                }
            },
            {
                data: 'id',
                render : function(data){
                    return `<div class="d-flex justify-content-center" style="gap:5px;"><button class="btn btn-sm btn-outline-info p-1" data-producto="${data}">
                        <small>
                        <i class="fas fa-eye"></i>
                         Visualizar
                        </small>
                    </button>
                    <button class="btn btn-sm btn-outline-danger p-1" data-producto="${data}">
                        <small>    
                        <i class="fas fa-trash-alt"></i>
                         Anular
                        </small>
                    </button></div>`
                }
            }
        ]
    }
    const datatableVentas = $('#misVentas').DataTable(configVentas);
    document.querySelector("#btnAplicarFiltro").onclick = e => datatableVentas.ajax.reload();

    function reporte(e) {
        const formulario = document.createElement("form");
        formulario.innerHTML = `
        <input value="${txtFechaFin.value}" name="fechaFin"/>
        <input value="${txtFechaInicio.value}" name="fechaInicio"/>
        <input value="${e.target.dataset.accion}" name="accion"/>
        `
        formulario.method = "POST";
        formulario.action = window.location.origin + "/intranet/bodega/reporte-ventas";
        const submit = document.createElement("input");
        submit.type = "submit";
        formulario.append(submit);
        document.body.append(formulario);
        submit.click();
        document.body.removeChild(formulario);
    }


    document.querySelector("#btnReporteDetalle").onclick = reporte;
    document.querySelector("#btnReporteDetalleExcel").onclick = reporte;

}
window.addEventListener("DOMContentLoaded",loadPage);