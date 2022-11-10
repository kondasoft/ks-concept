/*
    © 2022 KondaSoft.com
    https://www.kondasoft.com
*/
document.querySelectorAll('.ks-insta-gallery .splide').forEach(splideElement => {
    const splide = new Splide(splideElement, {
        type: 'loop',
        drag: 'free',
        focus: 'center',
        arrows: splideElement.dataset.arrows === '1',
        pagination: splideElement.dataset.pagination === '1',
        easing: splideElement.dataset.easing,
        speed: Number(splideElement.dataset.speed),
        gap: Number(splideElement.dataset.gap),
        mediaQuery: 'min',
        perPage: Number(splideElement.dataset.breakpointXs),
        breakpoints: {
            576: {
                perPage: Number(splideElement.dataset.breakpointSm)
            },
            768: {
                perPage: Number(splideElement.dataset.breakpointMd)
            },
            992: {
                perPage: Number(splideElement.dataset.breakpointLg)
            },
            1200: {
                perPage: Number(splideElement.dataset.breakpointXl)
            },
            1400: {
                perPage: Number(splideElement.dataset.breakpointXxl)
            }
        },
        autoScroll: {
            speed: Number(splideElement.dataset.autoscrollSpeed)
        }
    })
    splide.mount(window.splide.Extensions)
})
