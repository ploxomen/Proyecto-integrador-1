function loadPage(){
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
        })
    }
}
window.addEventListener("DOMContentLoaded",loadPage);