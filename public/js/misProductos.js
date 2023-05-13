function loadPage() {
    let helper = new Helper();
    const configTablaProductos = {
        ...helper.configuracionDataTable,
        "ajax": {
            "url": helper.urlProductos,
            "method" : "POST",
            "data": function ( d ) {
                d.accion = 'ver-productos';
            }
        },
        columns: [
            {
                data: 'id_producto',
                render: function(data,type,row, meta){
                    return meta.row + 1;
                }
            },
            {
                data: 'nombre'
            },
            {
                data: 'descripcion'
            },
            
            {
                data: 'categorias',
                render: function(data){
                    return  `<span class="badge text-bg-primary">` + data.split(';').join(`</span><span class="badge text-bg-primary">`) + "</span>";
                }
            },
            {
                data: 'nombre_marca'
            },
            {
                data: 'precio_compra',
                render : function(data){
                    return helper.resetearMoneda(data);
                }
            },
            {
                data: 'precio_venta',
                render : function(data){
                    return helper.resetearMoneda(data);
                }
            },
            {
                data: 'stock_minimo'
            },
            {
                data: 'stock'
            },
            {
                data: 'id_producto',
                render : function(data){
                    return `<div class="d-flex justify-content-center" style="gap:5px;"><button class="btn btn-sm btn-outline-info p-1" data-marca="${data}">
                        <small>
                        <i class="fas fa-pencil-alt"></i>
                        Editar
                        </small>
                    </button>
                    <button class="btn btn-sm btn-outline-danger p-1" data-marca="${data}">
                        <small>    
                        <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </small>
                    </button></div>`
                }
            }
        ]
    }
    console.log(configTablaProductos);
    $('#misProductos').DataTable(configTablaProductos);
}
window.addEventListener("DOMContentLoaded",loadPage);