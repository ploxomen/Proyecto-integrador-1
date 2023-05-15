function loadPage() {
    let helper = new Helper();
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
    const formularios = document.querySelectorAll("form");
    const boxFormulario1 = document.querySelector("#boxFormularioOcul1");
    const boxFormulario2 = document.querySelector("#boxFormularioOcul2");
    const boxFormulario3 = document.querySelector("#boxFormularioOcul3");
    const boxPasos = document.querySelectorAll(".paso"); 
    document.querySelector("#btnSiguientePrimero").onclick = e => document.querySelector("#formFrimero").click();
    document.querySelector("#btnSiguienteSegundo").onclick = e => document.querySelector("#formSegudo").click();
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
    document.querySelector("#btnCancelarTodo").onclick = e => {
        if(confirm("¿Deseas cancelar el proceso de agregar producto? Recuerda que todos los datos ingresados se perderan")){
            eliminarTodo();
        }
    }
    const boxImagenPrevia = document.querySelector("#boxImagenPrevia");
    const imagenPrevia = document.querySelector("#imagenPrevia");
    const fileProducto = document.querySelector("#formFile");

    function eliminarTodo(){
        boxFormulario1.hidden = false;
        boxFormulario2.hidden = true;
        boxFormulario3.hidden = true;
        for (const frm of formularios) {
            frm.reset();
        }
        boxPasos[0].querySelector(".regla").style.width = "0";
        boxPasos[1].style.backgroundColor = "";
        boxPasos[1].style.color = "";
        boxPasos[1].querySelector(".regla").style.width = "0";
        boxPasos[2].style.backgroundColor = "";
        boxPasos[2].style.color = "";
        $('#cbCategorias').val([]).trigger("change");
        $('#cbMarca').val([]).trigger("change");
        imagenPrevia.hidden = true;
        boxImagenPrevia.hidden = false;
        fileProducto.value = "";
    }
    formularios[0].addEventListener("submit",function(e){
        e.preventDefault();
        boxFormulario1.hidden = true;
        boxFormulario2.hidden = false;
        boxPasos[0].querySelector(".regla").style.width = "102px";
        boxPasos[1].style.backgroundColor = "var(--color-principal)";
        boxPasos[1].style.color = "#fff";
    });
    formularios[1].addEventListener("submit", function (e) {
        e.preventDefault();
        boxFormulario2.hidden = true;
        boxFormulario3.hidden = false;
        boxPasos[1].querySelector(".regla").style.width = "102px";
        boxPasos[2].style.backgroundColor = "var(--color-principal)";
        boxPasos[2].style.color = "#fff";
    });
    document.querySelector("#btnSiguienteFinalizar").addEventListener("click", function (e) {
        e.preventDefault();
        if (fileProducto.value == "" || !fileProducto.files.length){
            return alert("Por favor carge una imagen del producto");
        }
        if(validarEnteros()){
            return false;
        }
        let formData = new FormData(formularios[0]);
        let formDataDos = new FormData(formularios[1]);
        let formDataTres = new FormData(formularios[2]);
        for (let pair of formDataDos.entries()) {
            formData.append(pair[0], pair[1]);
        }
        for (let pair of formDataTres.entries()) {
            formData.append(pair[0], pair[1]);
        }
        formData.append('accion','agregar-producto');
        fetch(helper.urlProductos,{
            method: "POST",
            body : formData
        }).then(response => response.json())
        .then(data => {
            if(data.success){
                Swal.fire({
                    icon: 'success',
                    text: 'Producto registrado correctamente'
                }).then(result => {
                    eliminarTodo();
                })
            }
        }).catch(error => {
            console.error(error);
            alert("Error al registrar un producto");
        });
    });
    fileProducto.onchange = function(e){
        if(e.target.files.length){
            imagenPrevia.src = URL.createObjectURL(e.target.files[0]);
            imagenPrevia.hidden = false;
            boxImagenPrevia.hidden = true;
            return
        }
        imagenPrevia.hidden = true;
        boxImagenPrevia.hidden = false;
    }
    function validarEnteros(){
        for (const mCero of document.querySelectorAll(".mayor-cero")) {
            const valor = !isNaN(parseFloat(mCero.value)) ? parseFloat(mCero.value) : 0;
            if(valor<=0){
                Swal.fire({
                    icon: 'error',
                    text: 'El ' + mCero.dataset.valid + " debe ser mayor a cero"
                });
                return true;
            }
        }
        return false;
    }
}
window.addEventListener("DOMContentLoaded",loadPage);