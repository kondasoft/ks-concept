/*
    © 2022 KondaSoft.com
    https://www.kondasoft.com
*/

document.querySelectorAll('.ks-marquee-list').forEach(marqueeList => {
    const marqueeWidth = marqueeList.scrollWidth
    const marqueeLength = marqueeList.querySelectorAll('.ks-marquee-list-item').length

    marqueeList.insertAdjacentHTML('beforeEnd', marqueeList.innerHTML)
    marqueeList.insertAdjacentHTML('beforeEnd', marqueeList.innerHTML)

    marqueeList.querySelectorAll('li').forEach((item, index) => {
        if (index >= marqueeLength) {
            item.setAttribute('aria-hidden', 'true')
        }
    })

    const style = `
        <style>
            #ks-marquee-${marqueeList.dataset.moduleId} .ks-marquee-list {
                animation-name: ks-marquee-animation-${marqueeList.dataset.moduleId};
                animation-duration: ${marqueeList.dataset.animationDuration};
            }
            @keyframes ks-marquee-animation-${marqueeList.dataset.moduleId} {
                to { transform: translateX(-${marqueeWidth}px); }    
            }
        </style>
    `

    marqueeList.insertAdjacentHTML('beforeBegin', style)
})
