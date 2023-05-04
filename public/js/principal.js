function loadPage() {
    const swiper = new Swiper('#banerPrincipal', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },
    });
    const swiperProductos = new Swiper('#productosVendidos', {
        // Optional parameters
        direction: 'horizontal',
        slidesPerView: 4,
        spaceBetween: 30,
        // If we need pagination
        breakpoints: {
            '@0.75': {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            '@1.00': {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            '@1.50': {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
            clickable: true,
        },
    });

}
window.addEventListener("DOMContentLoaded",loadPage);