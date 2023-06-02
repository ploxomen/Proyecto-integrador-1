function loadPage(){
    let helper = new Helper();
    let idCliente = null;
    const envio = 10;
    let productos = [];
    const tablaProducto = document.querySelector("#llenarProducto");
    $('#cbProductos').select2({
        theme: 'bootstrap',
        width: '100%',
        placeholder: 'Seleccione un producto'
    }).on("select2:select",function(e){
        const valor = $(this).val();
        const index = productos.findIndex(p => p.id == valor);
        if(index < 0){
            let datos = new FormData();
            datos.append("producto",valor);
            datos.append("accion",'ver-producto');
            fetch(helper.urlVentasBodega,{
                method: "POST",
                body : datos
            }).then(response => response.json())
            .then(data => {
                if(data.error){
                    helper.alertaToast("error",data.error);
                    window.location.reload();
                    return false;
                }
                if(data.success && data.success[0]){
                    helper.alertaToast("success","Producto agregado correctamente");
                    if(!productos.length){
                        tablaProducto.innerHTML = "";
                    }
                    productos.push({
                        id : data.success[0].id,
                        nombre : data.success[0].nombre,
                        precio_venta : parseFloat(data.success[0].precio_venta),
                        cantidad : 1,
                        sub_total : parseFloat(data.success[0].precio_venta)
                    });
                    let tr = document.createElement("tr");
                    tr.dataset.producto = "producto_" + data.success[0].id;
                    tr.innerHTML = `
                    <td>${productos.length}</td>
                    <td>${data.success[0].nombre}</td>
                    <td><input style="max-width:70px;" type="number" class="form-control form-control-sm m-auto" data-producto="${data.success[0].id}" value="1"></td>
                    <td>${helper.resetearMoneda(data.success[0].precio_venta)}</td>
                    <td class="subtotal">${helper.resetearMoneda(data.success[0].precio_venta)}</td>
                    <td><button type="button" data-producto="${data.success[0].id}" class="btn btn-sm btn-danger" title="Eliminar producto"><i class="fas fa-trash-alt"></i></button></td>
                    `
                    tablaProducto.append(tr);
                    tr.querySelector("input").addEventListener("change",cambiarCantidad);
                }
                calcularCostos();
            }).catch(error => {
                console.error(error);
                alert("Error al seleccionar un producto");
            });
        }else{
            productos[index].cantidad++;
            productos[index].sub_total = productos[index].cantidad * productos[index].precio_venta;
            const tr = tablaProducto.querySelector(`[data-producto="producto_${productos[index].id}"]`);
            tr.querySelector("input").value = productos[index].cantidad;
            tr.querySelector(".subtotal").textContent = helper.resetearMoneda(productos[index].sub_total);
            helper.alertaToast("success","Producto incrementado correctamente");
            calcularCostos();
        }
    })
    function cambiarCantidad(e) {
        const cantidad = isNaN(e.target.value) ? 1 : parseInt(e.target.value);
        const index = productos.findIndex(p => p.id == e.target.dataset.producto);
        if(index >= 0){
            productos[index].cantidad = cantidad;
            productos[index].sub_total = productos[index].cantidad * productos[index].precio_venta;
            const tr = tablaProducto.querySelector(`[data-producto="producto_${productos[index].id}"]`);
            tr.querySelector("input").value = productos[index].cantidad;
            tr.querySelector(".subtotal").textContent = helper.resetearMoneda(productos[index].sub_total);
            e.target.value = cantidad;
            calcularCostos();
        }
    }
    function calcularCostos() {
        let total = 0;
        productos.forEach(p => {
            total += p.sub_total
        });
        document.querySelector("#txtSubtotal").textContent = helper.resetearMoneda(total - 0.18 * total);
        document.querySelector("#txtIgv").textContent = helper.resetearMoneda(0.18 * total);
        document.querySelector("#txtTotal").textContent = helper.resetearMoneda(total);
        document.querySelector("#infoCostoProducto").textContent = helper.resetearMoneda(total);
        document.querySelector("#cantidadFinal").textContent = helper.resetearMoneda(total + envio);
    }
    tablaProducto.onclick = function(e){
        if(e.target.classList.contains("btn-danger")){
            productos = productos.filter( p => p.id != e.target.dataset.producto)
            e.target.parentElement.parentElement.remove();
            if(!productos.length){
                tablaProducto.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center">Carrito vacío</td>
                </tr>
                `;
            }
            calcularCostos();
        }
    }
    $('#cbClientes').select2({
        theme: 'bootstrap',
        width: '100%',
        placeholder: 'Seleccione un cliente'
    }).on("select2:select",function(e){
        limpiarDatos("","","");
        let datos = new FormData();
        datos.append("cliente",$(this).val());
        datos.append("accion",'ver-cliente');
        fetch(helper.urlVentasBodega,{
            method: "POST",
            body : datos
        }).then(response => response.json())
        .then(data => {
            if(data.success && data.success[0]){
                idCliente = data.success[0].id;
                helper.alertaToast("success","Cliente seleccionado correctamente");
                limpiarDatos(data.success[0].direccion,data.success[0].celular,data.success[0].nombres + " " + data.success[0].apellidos);
            }
        }).catch(error => {
            console.error(error);
            alert("Error al seleccionar un cliente");
        });
    });
    const txtDireccionCliente = document.querySelector("#txtDireccion");
    const txtCelularCliente = document.querySelector("#txtCelular");

    function limpiarDatos(valorDireccion,valorCelular,valorCliente) {
        txtDireccionCliente.value = valorDireccion;
        txtCelularCliente.value = valorCelular;
        document.querySelector("#txtCopiaCliente").textContent = valorCliente;
        document.querySelector("#txtCopiaDireccion").textContent = valorDireccion;
        document.querySelector("#txtCopiaCelular").textContent = valorCelular;
    }
    document.querySelector("#btnSiguientePrimero").onclick = e => document.querySelector("#formFrimero").click();
    document.querySelector("#btnSiguienteSegundo").onclick = e => document.querySelector("#formSegudo").click();
    const boxFormulario1 = document.querySelector("#boxFormularioOcul1");
    const boxFormulario2 = document.querySelector("#boxFormularioOcul2");
    const boxFormulario3 = document.querySelector("#boxFormularioOcul3");
    const primerFormulario = document.querySelector("#primerFormulario");
    const segundoFormulario = document.querySelector("#segundoFormulario");

    const boxPasos = document.querySelectorAll(".paso"); 

    primerFormulario.addEventListener("submit",function(e){
        e.preventDefault();
        if(!idCliente){
            helper.alertaToast("error","Por favor seleccione un cliente");
        }
        boxFormulario1.hidden = true;
        boxFormulario2.hidden = false;
        boxPasos[0].querySelector(".regla").style.width = "102px";
        boxPasos[1].style.backgroundColor = "var(--color-principal)";
        boxPasos[1].style.color = "#fff";
    });
    segundoFormulario.addEventListener("submit",function(e){
        e.preventDefault();
        if(!productos.length){
            return helper.alertaToast("error","Por favor agregue al menos un producto");
        }
        let datos = new FormData();
        datos.append("accion","vericar-productos");
        datos.append("productos",JSON.stringify(productos));
        fetch(helper.urlVentasBodega,{
            method: "POST",
            body : datos
        }).then(response => response.json())
        .then(data => {
            if(data.session){
                helper.alertaToast("error",data.error);
                window.location.reload();
                return false;
            }
            if(data.error){
                return helper.sweetAlert("error",null,data.error);
            }
            if(data.success){
                boxFormulario2.hidden = true;
                boxFormulario3.hidden = false;
                boxPasos[1].querySelector(".regla").style.width = "102px";
                boxPasos[2].style.backgroundColor = "var(--color-principal)";
                boxPasos[2].style.color = "#fff";
            }
        }).catch(error => {
            console.error(error);
            alert("Error al seleccionar un producto");
        });
        
    });
    document.querySelector("#btnAtrasSegundo").onclick = e => {
        boxFormulario1.hidden = false;
        boxFormulario2.hidden = true;
        boxPasos[0].querySelector(".regla").style.width = "0";
        boxPasos[1].style.backgroundColor = "";
        boxPasos[1].style.color = "";
    }
    document.querySelector("#btnAtrasTercero").onclick = e => {
        boxFormulario2.hidden = false;
        boxFormulario3.hidden = true;
        boxPasos[1].querySelector(".regla").style.width = "0";
        boxPasos[2].style.backgroundColor = "";
        boxPasos[2].style.color = "";
    }
    document.querySelector("#btnSiguienteFinalizar").addEventListener("click", function (e) {
        e.preventDefault();
        let formData = new FormData(primerFormulario);
        formData.append("detalle",JSON.stringify(productos));
        formData.append("envio",envio);
        formData.append('accion','agregar-venta');
        fetch(helper.urlVentasBodega,{
            method: "POST",
            body : formData
        }).then(response => response.json())
        .then(data => {
            if(data.session){
                helper.alertaToast("error",data.session);
                window.location.reload();
                return false;
            }
            if(data.error){
                return helper.alertaToast("error",data.error);
            }
            if(data.success){
                Swal.fire({
                    icon: 'success',
                    text: data.success
                }).then(result => {
                    window.location.reload();
                });
            }
        }).catch(error => {
            console.error(error);
            alert("Error al registrar una venta");
        });
    });
    document.querySelector("#btnCancelarTodo").onclick = async e => {
        try {
            const alertaSweet = await helper.sweetAlertConfirm(null,"¿Deseas cancelar esta venta? Recuerda que todos los datos ingresados se perderan","Aceptar");
            if(alertaSweet.isConfirmed){
                window.location.reload();
            }
        } catch (error) {
            console.error(error);
            helper.alertaToast("error","Error al cancelar la venta");
        }
    }
}
window.addEventListener("DOMContentLoaded",loadPage);