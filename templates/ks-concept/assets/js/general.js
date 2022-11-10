/*
    © 2022 KondaSoft.com
    https://www.kondasoft.com
*/

// Mainmenu desktop - various adjustments for the megamenu
document.querySelectorAll('#mainmenu-desktop .nav-link.megamenu').forEach(link => {
    link.classList.remove('megamenu')
    link.parentElement.classList.add('megamenu')

    const hasContainer = link.closest('.container')
    const dropdownMenu = link.parentElement.querySelector('.dropdown-menu')
    dropdownMenu.outerHTML = `
        <div class="dropdown-menu">
            <div class="${hasContainer ? 'container' : 'container-fluid'}">
                <ul class="dropdown-menu-list">${dropdownMenu.innerHTML}</ul>
            </div>
        </div>
    `
});

// Smart Search on Mobile (various layout adjustments)
(() => {
    const collapse = document.querySelector('#smart-search-form-collapse-mobile')
    if (!collapse) { return }

    const searchIcon = document.querySelector('.smart-search-icon-link .icon-search')
    const closeIcon = document.querySelector('.smart-search-icon-link .icon-close')

    collapse.addEventListener('show.bs.collapse', event => {
        searchIcon.setAttribute('hidden', 'hidden')
        closeIcon.removeAttribute('hidden')
    })
    collapse.addEventListener('shown.bs.collapse', event => {
        event.target.querySelector('input[type="search"]').focus()
    })
    collapse.addEventListener('hide.bs.collapse', event => {
        searchIcon.removeAttribute('hidden')
        closeIcon.setAttribute('hidden', 'hidden')
    })
})()

// Search page - fix collapse for the "advanced search toggle"
document.querySelectorAll('[data-bs-target="#advancedSearch"]').forEach(btn => {
    let shown = false
    btn.addEventListener('click', () => {
        setTimeout(() => {
            if (shown) {
                const bsCollapse = bootstrap.Collapse.getOrCreateInstance('#advancedSearch')
                bsCollapse.hide()
            }
            shown = !shown
        }, 500)
    })
})

document.querySelectorAll('.com-finder__explained').forEach(elem => {
    elem.classList.add('alert', 'alert-info')
})
