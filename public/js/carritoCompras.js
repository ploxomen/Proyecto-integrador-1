function loadPage(){
    const url = window.location.origin + "/Http/Cliente/Compras.php";
    let envio = 10;
    const contenidoCarrito = document.querySelector("#contenidoCarrito");
    const btnCarritoCompras = document.querySelector("#btnCarritoCompras");
    contenidoCarrito.onclick = async function(e){
        console.log(e.target);
        if(e.target.classList.contains("btn-danger")){
            try {
                const alertaSweet = await helper.sweetAlertConfirm(null,"¿Deseas eliminar este producto del carrito?");
                if(alertaSweet.isConfirmed){
                    let datos = new FormData();
                    datos.append("accion","eliminar-producto-carrito");
                    datos.append("producto",e.target.dataset.producto);
                    const response = await helper.peticionHttp(url,"POST",datos);
                    if(response.reload){
                        helper.alertaToast("success","El producto se eliminó correctamente del carrito ...");
                        setTimeout(() => {
                            window.location.reload();
                        },1000)
                        return
                    }
                    if(response.producto){
                        helper.alertaToast("success","El producto se eliminó correctamente del carrito");
                        btnCarritoCompras.setAttribute("data-info",response.producto);
                        e.target.parentElement.parentElement.remove();
                        calcularCostos(response.total);
                    }
                }
            } catch (error) {
                console.error(error);
                helper.alertaToast("error","Error al eliminar el producto del carrito");
            }
        }
    }
    let helper = new Helper();
    for (const txtCantidad of document.querySelectorAll(".change-valor-cantidad")) {
        txtCantidad.addEventListener("change",cambiarValor);
    }
    async function cambiarValor(e){
        const cantidad = this.value;
        if(cantidad <= 0){
            return helper.alertaToast("error","La cantidad del producto debe ser mayor a 0");
        }
        if(cantidad > 25){
            return helper.alertaToast("error","La cantidad del producto no debe ser mayor a 25");
        }
        let datos = new FormData();
        datos.append("accion","modificar-carrito");
        datos.append("producto",e.target.dataset.producto);
        datos.append("cantidad",cantidad);
        try {
            const response = await helper.peticionHttp(url,"POST",datos);
            if(response.total){
                calcularCostos(response.total,response.subtotal,this.parentElement.parentElement.querySelector(".sub-total-tabla"))
                return helper.alertaToast("success","Cantidad modificada correctamente");
            }
        } catch (error) {
            console.error(error);
            return helper.alertaToast("error","Error al modificar la cantidad del al carrito");
        }finally{
            helper.cargandoPeticion(e.target,"",false);
        }
    }
    const boxPrimero = document.querySelector("#seccion1");
    const boxSegundo = document.querySelector("#seccion2");
    const boxTercero = document.querySelector("#seccion3");
    const boxPasos = document.querySelectorAll(".paso"); 

    document.querySelector("#btnSiguientePrimero").onclick = function(e){
        e.preventDefault();
        let mensajeError = null;
        for (const txtCantidad of document.querySelectorAll(".change-valor-cantidad")) {
            if(txtCantidad.value == "" || txtCantidad.value == null){
                mensajeError = "Las cantidades no deben de estar vacias";
                break
            }
            if(txtCantidad.value <= 0){
                mensajeError = "Las cantidades deben se ser mayor a cero";
                break
            }
            if(txtCantidad.value > 25){
                mensajeError = "Las cantidades deben se ser menor o igual a veinticinco";
                break
            }
        }
        if(mensajeError){
            return helper.alertaToast("error",mensajeError);

        }
        boxPrimero.hidden = true;
        boxSegundo.hidden = false;
        boxPasos[0].querySelector(".regla").style.width = "102px";
        boxPasos[1].style.backgroundColor = "var(--color-principal)";
        boxPasos[1].style.color = "#fff";
    }
    document.querySelector("#btnAtrasSegundo").onclick = function(e){
        e.preventDefault();
        boxPrimero.hidden = false;
        boxSegundo.hidden = true;
        boxPasos[0].querySelector(".regla").style.width = "0";
        boxPasos[1].style.backgroundColor = "";
        boxPasos[1].style.color = "";
    }
    document.querySelector("#btnAtrasTercero").onclick = e => {
        boxSegundo.hidden = false;
        boxTercero.hidden = true;
        boxPasos[1].querySelector(".regla").style.width = "0";
        boxPasos[2].style.backgroundColor = "";
        boxPasos[2].style.color = "";
    }
    document.querySelector("#btnSiguienteFinalizar").onclick = async e => {
        let datos = new FormData();
        datos.append("accion","eliminar-total-carrito");
        const response = await helper.peticionHttp(url,"POST",datos);
        if(response.success){
            const response2 = await helper.sweetAlert("success",null,"!Gracias por comprar en BODEGAFAST! tu pedido está en camino");
            if(response2.isConfirmed || !response2.isConfirmed){
                window.location.reload();
            }
        }
        if(response.error){
            helper.alertaToast("error",response.error);
        }
    }
    document.querySelector("#btnSiguienteSegundo").onclick = async function (e) {
        e.preventDefault();
        try {
           
            let datos = new FormData();
            datos.append("accion","verificar-autenticacion");
            const response = await helper.peticionHttp(url,"POST",datos);
            if(!response.token){
                return helper.sweetAlert("error","Sesión","Por favor inicia sesión para continuar con la compra");
            }else if(response.token && response.rol != 'rol_usuario'){
                return helper.sweetAlert("error","Usuario","Por favor inicia sesión como cliente para continuar con la compra");
            }else if(response.token && response.rol == 'rol_usuario'){
                document.querySelector("#alertaSession").hidden = true;
                document.querySelector("#txtNombres").value = response.nombres;
                document.querySelector("#txtApellidos").value = response.apellidos;
                if(document.querySelector("#txtDireccion").value == ""){
                    return helper.sweetAlert("error","Dirección","Por favor complete la dirección de envío");
                }
                if(document.querySelector("#txtCelular").value == ""){
                    return helper.sweetAlert("error","Sesión","Por favor complete el número de celular");
                }
                
                boxSegundo.hidden = true;
                boxTercero.hidden = false;
                boxPasos[1].querySelector(".regla").style.width = "102px";
                boxPasos[2].style.backgroundColor = "var(--color-principal)";
                boxPasos[2].style.color = "#fff";
                return
            }
            helper.alertaToast("error","No se puede pasar al siguiente paso");
            
        } catch (error) {
            console.error(error);
            helper.alertaToast("error","Error al cancelar la compra");
        }
    }
    function calcularCostos(costoTotal,costoSub = null,$subTotal = null){
        for (const costo of document.querySelectorAll(".info-costo-total")) {
            costo.textContent = "S/ " + costoTotal;
        }
        if($subTotal){
            $subTotal.textContent = "S/ " + costoSub;
        }
        document.querySelector("#cantidadFinal").textContent = helper.resetearMoneda(parseFloat(costoTotal) + envio);
    }
    document.querySelector("#btnCancelarTodo").onclick = async function(e){
        e.preventDefault();
        try {
            const alertaSweet = await helper.sweetAlertConfirm(null,"¿Deseas cancelar el proceso de compra?, al aceptar se eliminarán los productos seleccionados","Aceptar");
            if(alertaSweet.isConfirmed){
                let datos = new FormData();
                datos.append("accion","eliminar-total-carrito");
                const response = await helper.peticionHttp(url,"POST",datos);
                if(response.success){
                    helper.alertaToast("success",response.success);
                    setTimeout(() => {
                        window.location.reload();
                    },1000)
                    return
                }
                if(response.error){
                    helper.alertaToast("error",response.error);
                }
            }
        } catch (error) {
            console.error(error);
            helper.alertaToast("error","Error al cancelar la compra");
        }
    }
    
}
window.addEventListener("DOMContentLoaded",loadPage);