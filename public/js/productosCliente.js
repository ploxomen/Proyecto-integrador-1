function loadPage(){
    const url = window.location.origin + "/Http/Cliente/Compras.php";
    let helper = new Helper();
    const formularioFiltro = document.querySelector("#filtosBusqueda");
    const txtBusquedaProducto = document.querySelector("#txtNombreProducto");
    const cbOrdenProducto = document.querySelector("#cbOrdenProducto");
    const contenedorProductos = document.querySelector("#contendorProductos");
    const cargarProductosSpiner = document.querySelector("#cargandoProductos");
    const vacioProductos = document.querySelector("#productoVacio");


    async function cargarProductos() {
        contenedorProductos.innerHTML = "";
        vacioProductos.hidden = true;
        contenedorProductos.hidden = true;
        cargarProductosSpiner.hidden = false;
        let datos = new FormData(formularioFiltro);
        datos.append("accion","consultar-producto");
        datos.append("ordenProducto",cbOrdenProducto.value);
        datos.append("nombreProducto",txtBusquedaProducto.value);
        const response = await helper.peticionHttp(url,"POST",datos);
        let template = ""
        response.productos.forEach(producto => {
            template += `
            <div class="border p-3 un-producto">
                <div class="py-1">
                    <img src="${window.origin + '/public/img-productos/' + producto.img}" alt="">
                </div>
                <div class="text-center text-secondary">
                    <p class="mb-0">
                        <span>${producto.nombre}</span>
                    </p>
                    <p class="my-1">
                        <strong class="marca-texto">${producto.marca}</strong>
                    </p>
                    <p class="mb-0">
                        <strong class="bodega-texto">
                            <i class="fas fa-store-alt"></i>
                            ${producto.bodega}
                        </strong>
                    </p>
                    <p class="mb-2">
                        <strong class="titulo-principal-modulo precio">
                            ${helper.resetearMoneda(producto.precio_venta)}
                        </strong>
                    </p>
                    <div class="form-group d-flex" style="gap: 15px;">
                        <input type="number" class="form-control form-control-sm" value="1" min="0" max="25">
                        <button class="btn btn-sm btn-agregar-carrito py-2 px-3" data-producto="${producto.id}" data-nombre="${producto.nombre}">
                        <i></i>
                        AGREGAR
                        </button>
                    </div>
                </div>
            </div>
            
            `
        });
        cargarProductosSpiner.hidden = true;
        if(template != ''){
            contenedorProductos.hidden = false;
            contenedorProductos.innerHTML = template;
        }else{
            vacioProductos.hidden = false;
        }
    }
    cargarProductos();
    formularioFiltro.onclick = function(e){
        if(e.target.classList.contains("custom-control-input")){
            cargarProductos();
        }
    }
    let timeOut = null;
    txtBusquedaProducto.oninput = function(e){
        e.preventDefault();
        if(timeOut){
            clearTimeout(timeOut);
        }
        timeOut = setTimeout(() => {
            cargarProductos();
        }, 1000);
    }
    cbOrdenProducto.onchange = function(e){
        e.preventDefault();
        cargarProductos();
    }
    const btnCarritoCompras = document.querySelector("#btnCarritoCompras");
    contenedorProductos.onclick = async function(e){
        if(e.target.classList.contains("btn-agregar-carrito")){
            helper.cargandoPeticion(e.target,"fas fa-spinner fa-spin",true);
            let datos = new FormData();
            const cantidad = +e.target.parentElement.querySelector("input").value;
            if(cantidad <= 0){
                return helper.alertaToast("error","La cantidad del producto debe ser mayor a 0");
            }
            if(cantidad > 25){
                return helper.alertaToast("error","La cantidad del producto no debe ser mayor a 25");
            }
            datos.append("accion","agregar-carrito");
            datos.append("producto",e.target.dataset.producto);
            datos.append("nombre",e.target.dataset.nombre);
            datos.append("cantidad",cantidad);
            try {
                const response = await helper.peticionHttp(url,"POST",datos);
                if(response.producto){
                    btnCarritoCompras.setAttribute("data-info",response.producto);
                    btnCarritoCompras.classList.add("badge-notification");
                    return helper.alertaToast("success","Producto agregado al carrito");
                }
            } catch (error) {
                console.error(error);
                return helper.alertaToast("error","Error al agregar el producto al carrito");
            }finally{
                helper.cargandoPeticion(e.target,"",false);
            }
        }
    }
}
window.addEventListener("DOMContentLoaded",loadPage);