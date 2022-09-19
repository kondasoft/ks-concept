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
})
