/*!
    * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2022 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#menu-hamburguesa');
    if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        document.querySelector(".cabecera").classList.toggle('sb-sidenav-toggled');
    }
    sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        document.querySelector(".cabecera").classList.toggle('sb-sidenav-toggled');
        localStorage.setItem('sb|sidebar-toggle', document.querySelector(".cabecera").classList.contains('sb-sidenav-toggled'));
    });
    

});
