jQuery(document).ready(function($){
    const search = window.location.search
    const params = new URLSearchParams(search)

    const formatter = wNumb({ decimals: 0 })
    const media_query = window.matchMedia('(max-width: 990px)')

    const $slider = document.querySelector('.slider__slider')

    let start = 0
    let end = 30

    if(params.has('time')){
        const initialTime = JSON.parse(params.get('time'))

        start = initialTime[0]
        end = initialTime[1]
    }

    noUiSlider.create($slider, {
        start: [start, end],
        step: 1,
        connect: true,
        tooltips: true,
        range: {
            'min': 0,
            'max': 30
        },
        format: wNumb({
            decimals: 0,
            suffix: ' хв'
        })
    })

    $slider.noUiSlider.on('change', function(values, handle, unencoded){
        updateUrl(formatter.to(unencoded[0]), formatter.to(unencoded[1]))
    })


    function updateUrl(from, to){
        if(params.has('time')){
            params.set('time', '[' + from + ', ' + to + ']')
        }
        else{
            params.append('time', '[' + from + ', ' + to + ']')
        }

        if(params.has('page')){
            params.delete('page')
        }

        if(media_query.matches){
            $(window).on('sidebarclosed', function(){
                window.location.search = params.toString()
            })
        }
        else{
            window.location.search = params.toString()
        }
    }
})