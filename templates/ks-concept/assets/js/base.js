/*
    © 2022 KondaSoft.com
    https://www.kondasoft.com
*/

// Theme info in the console
console.log('Premium Joomla Template Developed By KondaSoft | Learn more at https://www.kondasoft.com')

// Init Bootstrap tooltips
document.querySelectorAll('[data-bs-toggle="tooltip"]')
    .forEach((el) => new bootstrap.Tooltip(el))

// Init Bootstrap popovers
document.querySelectorAll('[data-bs-toggle="popover"]')
    .forEach((el) => new bootstrap.Popover(el))

// Debounce helper function
window.debounce = (callback, wait = 200) => {
    let timeout
    return (...args) => {
        const context = this
        clearTimeout(timeout)
        timeout = setTimeout(() => callback.apply(context, args), wait)
    }
}

// Enter view detection
enterView({
    selector: '.enter-view',
    enter: (el) => {
        el.classList.add('entered')
    },
    exit: (el) => { },
    progress: (el, progress) => { },
    offset: 0.4,
    once: true
})
