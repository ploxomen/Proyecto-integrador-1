window.addEventListener('DOMContentLoaded', event => {
    let helper = new Helper();
    const sidebarToggle = document.body.querySelector('#menu-hamburguesa');
    if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        document.querySelector(".cabecera").classList.toggle('sb-sidenav-toggled');
    }
    sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        document.querySelector(".cabecera").classList.toggle('sb-sidenav-toggled');
        localStorage.setItem('sb|sidebar-toggle', document.querySelector(".cabecera").classList.contains('sb-sidenav-toggled'));
    });
    async function closeSession(e){
        const alertaSweet = await helper.sweetAlertConfirm(null,"¿Deseas cerrar sesión?","Aceptar");
        if(alertaSweet.isConfirmed){
            window.location.href = window.origin + "/usuario/cerrar-sesion";
        }
    }
    for (const btnSession of document.querySelectorAll(".cerrar-sesion")) {
        btnSession.addEventListener("click",closeSession);
    }
});
