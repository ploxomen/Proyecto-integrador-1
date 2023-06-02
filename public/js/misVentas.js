function loadPage() {
    let helper = new Helper();
    const configVentas = {
        ...helper.configuracionDataTable,
        "ajax": {
            "url": helper.urlVentasBodega,
            "method" : "POST",
            "data": function ( d ) {
                d.accion = 'ver-ventas';
            }
        },
        columns: [
            {
                data: 'nroVenta'
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

}
window.addEventListener("DOMContentLoaded",loadPage);