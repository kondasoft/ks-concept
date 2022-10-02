/*
    © 2022 KondaSoft.com
    https://www.kondasoft.com
*/

document.querySelectorAll('.ks-image-overlay-with-text').forEach(section => {
    const imgMobile = section.querySelector('.img-mobile')
    const imgDesktop = section.querySelector('.img-desktop')

    // eslint-disable-next-line new-cap, no-new
    new simpleParallax(imgMobile, {
        orientation: imgMobile.dataset.parallaxOrientation,
        scale: Number(imgMobile.dataset.parallaxScale / 100)
    })

    // eslint-disable-next-line new-cap, no-new
    new simpleParallax(imgDesktop, {
        orientation: imgDesktop.dataset.parallaxOrientation,
        scale: Number(imgDesktop.dataset.parallaxScale / 100)
    })
})