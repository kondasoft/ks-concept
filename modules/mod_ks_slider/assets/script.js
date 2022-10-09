/*
    © 2022 KondaSoft.com
    https://www.kondasoft.com
*/
document.querySelectorAll('.ks-slider .splide').forEach(splideElement => {
    const splide = new Splide(splideElement, {
        arrows: splideElement.dataset.arrows === '1',
        pagination: splideElement.dataset.pagination === '1',
        easing: splideElement.dataset.easing,
        speed: Number(splideElement.dataset.speed),
        autoplay: splideElement.dataset.autoplay === '1',
        interval: Number(splideElement.dataset.interval),
        rewind: splideElement.dataset.rewind === '1',
        gap: '1rem',
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
                perPage: Number(splideElement.dataset.breakpointXl),
                gap: '1.5rem'
            },
            1400: {
                perPage: Number(splideElement.dataset.breakpointXxl),
                gap: '1.5rem'
            }
        }
    })
    splide.mount()
})
