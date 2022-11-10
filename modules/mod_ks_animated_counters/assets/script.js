/*
    © 2022 KondaSoft.com
    https://www.kondasoft.com
*/

// https://css-tricks.com/animating-number-counters/
const animateValue = (obj, start, end, duration) => {
    let startTimestamp = null
    const step = (timestamp) => {
        if (!startTimestamp) {
            startTimestamp = timestamp
        }
        const progress = Math.min((timestamp - startTimestamp) / duration, 1)
        obj.innerHTML = Math.floor(progress * (end - start) + start)

        if (progress < 1) {
            window.requestAnimationFrame(step)
        }
    }
    window.requestAnimationFrame(step)
}

document.querySelectorAll('.ks-animated-counters-number').forEach(element => {
    enterView({
        selector: [element],
        enter: (el) => {
            animateValue(element, 0, Number(element.dataset.number), Number(element.dataset.duration))
        },
        exit: (el) => { },
        progress: (el, progress) => { },
        offset: 0.1,
        once: true
    })

    setTimeout(() => {
        if (element.closest('.enter-view').classList.contains('entered')) {
            animateValue(element, 0, Number(element.dataset.number), Number(element.dataset.duration))
        }
    }, 500)
})
