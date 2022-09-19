/*
    © 2022 KondaSoft.com
    https://www.kondasoft.com
*/

class SmartSearch extends HTMLElement {
    constructor () {
        super()

        this.form = this.querySelector('form')
        this.input = this.querySelector('input[type="search"]')
        this.status = this.querySelector('[role="status"]')
        this.dropdownMenu = this.querySelector('.dropdown-menu')

        this.searchTerm = ''
        this.suggestions = []

        this.input.addEventListener('input', window.debounce((event) => {
            this.onChange(event)
        }, 300).bind(this))
    }

    async onChange () {
        this.searchTerm = this.input.value.trim()
        // console.log(searchTerm)

        if (this.searchTerm.length < 2) {
            this.close()
        } else {
            const response = await fetch(`${this.form.dataset.baseUrl}/index.php/component/finder/?task=suggestions.suggest&format=json&q=${this.searchTerm}`)
            // console.log(response)

            if (!response.ok) {
                const error = new Error(response.status)
                this.close()
                throw error
            }

            const data = await response.json()
            this.suggestions = data.suggestions

            if (this.suggestions.length) {
                this.open()
            } else {
                this.close()
            }
        }

        this.setStatus()
    }

    setStatus () {
        if (this.searchTerm.length < 2) {
            this.status.textContent = this.status.dataset.textInit
        } else if (this.suggestions.length === 0) {
            this.status.textContent = this.status.dataset.textNoResults
        } else if (this.suggestions.length === 1) {
            this.status.textContent = this.status.dataset.textOneResult
        } else if (this.suggestions.length > 1) {
            this.status.textContent = this.suggestions.length + ' ' + this.status.dataset.textResultsFound
        } else {
            this.status.textContent = this.status.dataset.textError
        }
    }

    open () {
        console.log(this.form.getAttribute('action'))
        this.dropdownMenu.innerHTML = ''
        this.suggestions.forEach(suggestion => {
            this.dropdownMenu.innerHTML += `
                <li role="option" aria-selected="false">
                    <a class="dropdown-item" href="${this.form.dataset.baseUrl}/${this.form.dataset.searchRoute}?q=${suggestion}">
                        <mark>${suggestion}</mark>
                    </a>
                </li>
            `
        })
        this.input.setAttribute('aria-expanded', 'true')
        this.dropdownMenu.classList.add('show')
    }

    close () {
        this.input.setAttribute('aria-expanded', 'false')
        this.dropdownMenu.innerHTML = ''
        this.dropdownMenu.classList.remove('show')
    }
}

customElements.define('smart-search', SmartSearch)
