function loadPage(){
    const helper = new Helper();
    for (const btnLogin of document.querySelectorAll(".btn-login")) {
        btnLogin.addEventListener("click",function(e){
            if (this.classList.contains("activo-login")){
                return 
            }
            for (const btnLogin of document.querySelectorAll(".btn-login")) {
                btnLogin.classList.remove("activo-login");
            }
            this.classList.add("activo-login");
            const validacion = e.target.dataset.type == "login";
            document.querySelector("#frmLogin").hidden = validacion ? false : true;
            document.querySelector("#frmRegistro").hidden = validacion;
        });
    }
    const frmLogin = document.querySelector("#frmLogin");
    frmLogin.addEventListener("submit",async function (e) {
        e.preventDefault();
        let datos = new FormData(this);
        datos.append("accion","autenticar");
        try {
            const response = await helper.peticionHttp(helper.urlLogin,"POST",datos);
            if(response.success){
                helper.alertaToast("success",response.success);
                setTimeout(st=>{
                    window.location.reload();
                },1000);
                return
            }
            if(response.error){
                return helper.alertaToast("error",response.error);
            }
        } catch (error) {
            console.error(error);
            return helper.alertaToast("error","Error al iniciar sesión");
        }
    });
    const frmCrearUsuario = document.querySelector("#frmRegistro");
    frmCrearUsuario.addEventListener("submit",async function (e) {
        e.preventDefault();
        let datos = new FormData(this);
        datos.append("accion","crear-cuenta");
        try {
            const response = await helper.peticionHttp(helper.urlLogin,"POST",datos);
            if(response.success){
                helper.alertaToast("success",response.success);
                setTimeout(st=>{
                    window.location.reload();
                },1000);
                return
            }
            if(response.error){
                return helper.alertaToast("error",response.error);
            }
        } catch (error) {
            console.error(error);
            return helper.alertaToast("error","Error al crear una cuenta");
        }
    });
}
window.addEventListener("DOMContentLoaded",loadPage);