function loadPage(){
    const url = window.location.origin + "/Http/Cliente/Compras.php";
    //Llave pública que te proporciona culqi
    Culqi.publicKey = 'pk_test_5363217173e180bb';
    //Opciones para habilitar la variedad de metodos de pago
    Culqi.options({
        lang: "auto",
        installments: false,
        paymentMethods: {
            tarjeta: true,
            bancaMovil: true,
            agente: true,
            billetera: true,
            cuotealo: true,
            yape: true
        },
        //Estilos para darle color a la pasarela de pagos
        style: {
            bannerColor: '#F8B602',
            menuColor: '#F8B602',
            linksColor: '#F8B602'
        }
    });
    let paymentTypeAvailable = null;
    const envio = 10;
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
        datos.append("nombre",e.target.dataset.nombre);
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

    document.querySelector("#btnSiguientePrimero").onclick = async function(e){
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
        try {
            let datos = new FormData();
            datos.append("accion","verificar-productos");
            const response = await helper.peticionHttp(url,"POST",datos);
            if(response.error){
                return helper.sweetAlert("error",null,response.error);
            }else if(response.success){
                boxPrimero.hidden = true;
                boxSegundo.hidden = false;
                boxPasos[0].querySelector(".regla").style.width = "102px";
                boxPasos[1].style.backgroundColor = "var(--color-principal)";
                boxPasos[1].style.color = "#fff";
            }
        } catch (error) {
            console.error(error);
            helper.alertaToast("error","Error al consultar producto");
        }
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
    
    const formDatos = document.querySelector("#frmDatos");
    document.querySelector("#btnSiguienteFinalizar").onclick = async e => {
        Culqi.open();
        e.preventDefault();
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
                //Recepcion de las ordenes para la asignacion del monto a pagar
                Culqi.settings({
                    title: 'BODEGAFAST',
                    currency: 'PEN',  
                    amount: response.orden.amount,
                    order: response.orden.id
                });
                //Validacion de metodos de pago
                Culqi.validationPaymentMethods();
                paymentTypeAvailable = Culqi.paymentOptionsAvailable;
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