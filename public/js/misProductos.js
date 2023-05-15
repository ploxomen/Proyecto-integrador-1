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
                    return `<div class="d-flex justify-content-center" style="gap:5px;"><button class="btn btn-sm btn-outline-info p-1" data-producto="${data}">
                        <small>
                        <i class="fas fa-pencil-alt"></i>
                        Editar
                        </small>
                    </button>
                    <button class="btn btn-sm btn-outline-danger p-1" data-producto="${data}">
                        <small>    
                        <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </small>
                    </button></div>`
                }
            }
        ]
    }
    const datatableProductos = $('#misProductos').DataTable(configTablaProductos);
    const tablaMisProductos = document.querySelector("#misProductos");
    const modalEditarProdcuto = document.querySelector("#editarProductoModal");
    const modalProducto = new bootstrap.Modal(modalEditarProdcuto);
    tablaMisProductos.querySelector("tbody").addEventListener("click",async function(event){
        if(event.target.classList.contains("btn-outline-info")){
            modalProducto.show();
        }
        if(event.target.classList.contains("btn-outline-danger")){
            const idProducto = event.target.dataset.producto;
            try {
                const alertaSweet = await helper.sweetAlertConfirm(null,"¿Deseas eliminar este producto?");
                if(alertaSweet.isConfirmed){
                    let datos = new FormData();
                    datos.append("accion","eliminar-producto");
                    datos.append("idProducto",idProducto);
                    const response = await helper.peticionHttp(helper.urlProductos,"POST",datos);
                    if(response.success){
                        datatableProductos.ajax.reload();
                    }
                    helper.alertaToast(response.success ? "success" : "error", response.success ? response.success : "Error al eliminar el producto");
                }
            } catch (error) {
                helper.alertaToast("error","error al eliminar el producto");
                console.error(error);
            }
        }
    });
    $('#cbCategorias').select2({
        theme: 'bootstrap',
        width: '100%',
        placeholder: 'Seleccione las categorías'
    });
    $('#cbMarca').select2({
        theme: 'bootstrap',
        width: '100%',
        placeholder: 'Seleccione una marca'
    });
}
window.addEventListener("DOMContentLoaded",loadPage);