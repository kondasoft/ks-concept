/*
    © 2022 KondaSoft.com
    https://www.kondasoft.com
*/

document.querySelectorAll('.ks-testimonials .splide').forEach(splideElement => {
    const splide = new Splide(splideElement, {
        arrows: splideElement.dataset.arrows === '1',
        pagination: splideElement.dataset.pagination === '1',
        easing: splideElement.dataset.easing,
        speed: Number(splideElement.dataset.speed),
        autoplay: splideElement.dataset.autoplay === '1',
        interval: Number(splideElement.dataset.interval),
        rewind: splideElement.dataset.rewind === '1'
    })

    splide.on('arrows:updated', () => {
        // splideElement.querySelector('.img-wrapper').insertAdjacentElement('afterbegin', splideElement.querySelector('.splide__arrows'))
    })

    splide.mount()
})
