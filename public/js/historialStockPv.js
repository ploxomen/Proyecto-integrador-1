function loadPage(){
    let helper = new Helper();
    const configDb = {
        ...helper.configuracionDataTable,
        "ajax": {
            "url": helper.urlAccionHistorial,
            "method" : "POST",
            "data": function ( d ) {
                d.acciones = 'ver-historial';
                d.producto = $('#cbProductos').val();
            }
        },
        columns: [
            {
                data: 'id',
                render: function(data,type,row, meta){
                    return meta.row + 1;
                }
            },
            {
                data: 'fechaHr'
            },
            {
                data: 'cantidad',
                render : function(data){
                    return !isNaN(+data) ? +data : 0;
                }
            },
            {
                data: 'precio_venta',
                render : function(data){
                    return helper.resetearMoneda(data);
                }
            },
            {
                data: 'descuento',
                render : function(data){
                    return helper.resetearMoneda(data);
                }
            }
        ]
    }
    const datatableHistorial = $('#misHistoriales').DataTable(configDb);
    $('#cbProductos').select2({
        theme: 'bootstrap',
        width: '100%',
        placeholder: 'Seleccione un producto'
    }).on("select2:select",function(e){
        datatableHistorial.ajax.reload();
    })
    const btnEditarModal = document.querySelector("#btnEditarCantidad");
    const txtEditarStock = {
        producto : document.querySelector("#nombreProducto"),
        cantidad : document.querySelector("#txtStock"),
        descuento : document.querySelector("#txtDescuento"),
        pv : document.querySelector("#txtPrecioVenta")
    }
    let idProducto = null;
    const frmHistorial = document.querySelector("#frmEditarStock");
    frmHistorial.addEventListener("submit",async function(e){
        e.preventDefault();
        let datos = new FormData(this);
        datos.append("acciones","editar-stock");
        datos.append("producto",idProducto);
        try {
            const response = await helper.peticionHttp(helper.urlAccionHistorial,"POST",datos);
            if(response.session){
                return window.location.reload();
            }
            if(response.success){
                helper.alertaToast("success",response.success);
                $('#editarStock').modal("hide");
                datatableHistorial.ajax.reload();
            }
        } catch (error) {
            console.error(error);
            helper.alertaToast("error","Error al editar los datos del producto");
        }
    })
    document.querySelector("#btnActualiarStock").onclick = e => document.querySelector("#frmEnviar").click();
    btnEditarModal.onclick = async e => {
        e.preventDefault();
        const valProducto = $('#cbProductos').val();
        if(!valProducto){
            return helper.alertaToast("error","Por favor seleccione un producto");
        }
        let datos = new FormData();
        datos.append("acciones","solicitar-stock");
        datos.append("producto",valProducto);
        try {
            const response = await helper.peticionHttp(helper.urlAccionHistorial,"POST",datos);
            if(response.session){
                return window.location.reload();
            }
            if(response.producto && response.producto[0]){
                const producto = response.producto[0];
                txtEditarStock.producto.value = producto.nombre;
                txtEditarStock.cantidad.value = producto.stock;
                txtEditarStock.descuento.value = producto.descuento;
                txtEditarStock.pv.value = producto.precio_venta;
                idProducto = producto.id;
                $('#editarStock').modal("show");
            }
        } catch (error) {
            console.error(error);
            helper.alertaToast("error","Error al solicitar el producto");
        }
    }
    $('#editarStock').on('hidden.bs.modal', function () {
        idProducto = null;
        frmHistorial.reset();
    })
}
window.addEventListener("DOMContentLoaded",loadPage);