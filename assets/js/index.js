jQuery(document).ready(function($){
    let crypto = { utils: {} }

    crypto.init = function(){
        // Generic
        this.maybeStretchSiteContentWrapper()
        this.initSidebar()
        this.initPasswordField()
        this.initAccordeon()
        this.initCarousels()
        this.initModals()
        this.initPhoneMask()
        this.initImagePicker()

        // Header
        this.initHeaderSearch()
        this.initMobileHeader()

        // Login page
        this.initLoginTabs()

        // Dashboard
        this.initDashboardTabs()

        // Terms
        this.initTermsExpanding()
        this.initTermsInfiniteScroll()
        this.initTermsSearch()

        // Article
        this.initArticleLikes()
        this.initArticleTerms()
    }


    // Utils

    crypto.utils.isElementOverflowing = function($element){
        const el = $element instanceof jQuery ? $element[0] : $element

        const current_overflow = el.style.overflow

        if(!current_overflow || current_overflow === 'visible')
            el.style.overflow = 'hidden'

        const is_overflowing = el.clientWidth < el.scrollWidth || el.clientHeight < el.scrollHeight

        el.style.overflow = current_overflow

        return is_overflowing
    }

    crypto.utils.disableBodyScroll = function(){
        $('body').css('overflow-y', 'hidden')
    }

    crypto.utils.enableBodyScroll = function(){
        $('body').css('overflow-y', '')
    }

    crypto.utils.showDimmer = function(){
        this.disableBodyScroll()
        $('body').append('<div class="dimmer"></div>')
    }

    crypto.utils.hideDimmer = function(){
        this.enableBodyScroll()
        $('.dimmer').remove()
    }

    crypto.utils.debounce = function(func, wait = 500){
        let timeout

        return function executed(...args){
            const later = () => {
                clearTimeout(timeout)
                func(...args)
            }

            clearTimeout(timeout)
            timeout = setTimeout(later, wait)
        }
    }


    // Generic

    crypto.maybeStretchSiteContentWrapper = function(){
        stretchSiteContent()

        $(window).resize(stretchSiteContent)

        function stretchSiteContent(){
            const viewport_height = $(window).height()
            const body_height = $('body').height()

            if(body_height < viewport_height){
                const wrapper_height = viewport_height - $('header.header').outerHeight() - $('footer.footer').outerHeight()
                $('.site-content').css('min-height', wrapper_height)
            }
        }
    }

    crypto.initSidebar = function(){
        if(!$('.sidebar').length) return

        const _this = this

        const $toggler = $('.sidebar-toggle')
        const $sidebar = $('.sidebar')

        $toggler.on('click', '.sidebar-toggle__button', function(){
            _this.utils.showDimmer()
            $sidebar.addClass('sidebar--active')
        })

        $sidebar.on('click', '.sidebar__close, .sidebar__footer .btn', function(){
            _this.utils.hideDimmer()
            $sidebar.removeClass('sidebar--active')
            $(window).trigger('sidebarclosed')
        })

        $('body').on('click', '.dimmer', function(){
            _this.utils.hideDimmer()
            $sidebar.removeClass('sidebar--active')
            $(window).trigger('sidebarclosed')
        })
    }


    crypto.initPasswordField = function(){
        if(!$('.input--password').length) return

        $('.input--password').on('click', '.input__button', function(){
            const $input = $(this).closest('.input__wrap').find('.input__input')
            const current_type = $input.attr('type')

            if(current_type === 'password'){
                $input.attr('type', 'text')
            }
            else{
                $input.attr('type', 'password')
            }
        })
    }


    crypto.initAccordeon = function(){
        if(!('.accordeon').length) return

        const $accordeon = $('.accordeon')

        $accordeon.on('click', '.accordeon-item__header', function(){
            const $item = $(this).closest('.accordeon-item')
            const $body = $item.find('.accordeon-item__body')
            const $content = $item.find('.accordeon-item__content')
            
            if(!$item.hasClass('accordeon-item--expanded')){
                $item.addClass('accordeon-item--expanded')

                $body.css({
                    height: $content.height() + 15,
                    opacity: 1
                })
            }
            else{
                $item.removeClass('accordeon-item--expanded')

                $body.css({
                    height: 0,
                    opacity: 0
                })
            }
        })

        $(window).resize(function(){
            $accordeon.find('.accordeon-item--expanded').each(function(){
                const $body = $(this).find('.accordeon-item__body')
                const $content = $body.find('.accordeon-item__content')

                $body.css('height', $content.height() + 15)
            })
        })
    }


    crypto.initCarousels = function(){
        if(!$('.carousel').length) return

        const $carousels = $('.carousel')

        const media_query = window.matchMedia('(max-width: 560px)')

        $carousels.each(function(){
            const $carousel = $(this)

            let swiper = null
            let cfg = {}

            if($(this).hasClass('carousel--partners')){
                cfg = {
                    loop: false,
                    slidesPerView: 'auto',
                    spaceBetween: 20,
                    navigation: {
                        prevEl: '.carousel__prev',
                        nextEl: '.carousel__next'
                    }
                }
            }

            if(media_query.matches){
                console.log('matches')
                swiper = new Swiper($carousel[0], cfg)
            }

            media_query.addEventListener('change', function(e){
                if(!e.matches && swiper){
                    swiper.destroy(true, true)
                }
                else if(e.matches){
                    swiper = new Swiper($carousel[0], cfg)
                }
            })
        })
    }


    crypto.initModals = function(){
        if(!$('.modal').length) return

        $('a[href^="#modal"]').on('click', function(e){
            e.preventDefault()

            MicroModal.show($(this).attr('href').replace('#', ''), {
                openClass: 'modal--active',
                disableScroll: true,
                awaitOpenAnimation: true,
                awaitCloseAnimation: true
            })

            return false
        })
    }


    crypto.initPhoneMask = function(){
        if(!$('input[type="tel"]').length) return

        $('input[type="tel"]').each(function(){
            IMask($(this)[0], { mask: '+{38} 000 000 00 00' })
        })
    }


    crypto.initImagePicker = function(){
        if(!$('.image-picker').length) return

        const $picker = $('.image-picker')
        const $cropper = $('.image-cropper')

        let cropper = null

        $picker.on('change', '.image-picker__input', function(e){
            if(!e.target.files.length) return

            const file = new FileReader()

            file.onload = function(event){
                const $image = $cropper.find('.image-cropper__image')

                $image.attr('src', event.target.result)

                if(!cropper){
                    cropper = new Cropper($image[0], {
                        aspectRatio: 1,
                        movable: false,
                        scalable: false,
                        zoomable: false,
                        zoomOnWheel: false,
                        minCropBoxWidth: 150,
                        minCropBoxHeight: 150
                    })
                }
                else{
                    cropper.replace(event.target.result)
                }

                MicroModal.show('modal-avatar-cropping', {
                    openClass: 'modal--active',
                    disableScroll: true,
                    awaitOpenAnimation: true,
                    awaitCloseAnimation: true
                })

                $cropper.on('click', '.image-cropper__submit', function(){
                    cropper.getCroppedCanvas({ width: 150, height: 150 }).toBlob(function(blob){
                        const file = new File([blob], e.target.files[0].name, { type: e.target.files[0].type } )
                        const container = new DataTransfer()

                        container.items.add(file)

                        e.target.files = container.files

                        $picker.find('.image-picker__preview').attr('src', window.URL.createObjectURL(blob))
                    })
                })
            }

            file.readAsDataURL(e.target.files[0])
        })
    }


    // Header

    crypto.initHeaderSearch = function(){
        if(!$('.header-search').length) return

        const _this = this

        const $search = $('.header-search')

        let results_html = ''
        const media_query = window.matchMedia('(max-width: 1024px)')

        media_query.addEventListener('change', function(e){
            if(e.matches){
                $search.find('.header-search__input').val('')
                hideSearchResults()
            }
        })

        $search.on('focus', '.header-search__input', function(){
            $search.addClass('header-search--focus')

            if(results_html){
                showSearchResults()
            }
        })

        $search.on('input', '.header-search__input', _this.utils.debounce(function(e){
            const keyword = e.target.value

            if(keyword.length){
                $.ajax({
                    method: 'POST',
                    url: ccpt_data.ajax_url,
                    data: {
                        'action': 'search_articles',
                        'keyword': keyword
                    },
                    beforeSend: function(){
                        $search.addClass('header-search--loading')
                    },
                    success: function(res){
                        $search.removeClass('header-search--loading')

                        if(res.status === 'html'){
                            results_html = res.message
                            showSearchResults()
                        }
                    }
                })
            }
            else{
                results_html = ''
                hideSearchResults()
            }
        }, 500))

        $('body').on('mousedown', function(e){
            if(!$(e.target).closest('.header-search, .header-search-results').length){
                $search.removeClass('header-search--focus')
                hideSearchResults()
            }
        })

        $search.on('submit', '.header-search__form', function(e){
            e.preventDefault()

            return false
        })

        function showSearchResults(){
            if(!$('.header-search-results').length){
                $('<div class="header-search-results">' + results_html + '</div>').appendTo('body')

                setTimeout(() => {
                    $('.header-search-results').css({
                        transform: 'translateY(0)',
                        opacity: 1
                    })
                }, 10)
            }
            else{
                $('.header-search-results').html(results_html)
            }

            const $results = $('.header-search-results')

            $results.css({
                left: $search.offset().left + 'px',
                top: parseInt($search.offset().top) + parseInt($search.height()) + 1 + 'px',
                width: $search.width() + 'px'
            })

            $(window).resize(function(){
                $results.css({
                    left: $search.offset().left + 'px',
                    top: parseInt($search.offset().top) + parseInt($search.height()) + 1 + 'px',
                    width: $search.width() + 'px'
                })
            })
        }

        function hideSearchResults(){
            $('.header-search-results').css({
                transform: 'translateY(10px)',
                opacity: 0
            }).on('transitionend', function(){
                $(this).remove()
            })
        }
    }


    crypto.initMobileHeader = function(){
        const $toggler = $('.header .burger')
        const $mobile_header = $('.header__mobile')

        $toggler.on('click touchstart', function(){
            $(this).toggleClass('active')
            $mobile_header.toggleClass('open')
        })

        $('body').on('click', function(e){
            if(!$(e.target).closest('.header, .header-search-results').length){
                $toggler.removeClass('active')
                $mobile_header.removeClass('open')
            }
        })
    }


    // Login page

    crypto.initLoginTabs = function(){
        if(!$('.login').length) return

        const $login = $('.login')
        const $togglers = $login.find('.login__title')

        const media_query = window.matchMedia('(max-width: 768px)')

        if(media_query.matches){
            $login.find('.login__tab:first-child, .login__title:first-child').attr('data-active', '')
            $togglers.on('click', toggleTabsHandler)
        }

        media_query.addEventListener('change', function(e){
            if(e.matches){
                $login.find('.login__tab:first-child, .login__title:first-child').attr('data-active', '')
                $togglers.on('click', toggleTabsHandler)
            }
            else{
                $login.find('.login__tab, .login__title').removeAttr('data-active', '')
                $togglers.off('click', toggleTabsHandler)
            }
        })

        function toggleTabsHandler(e){
            const $target = $(e.target)
            const tab_name = $target.data('tab')

            
            $login.find('.login__tab, .login__title').removeAttr('data-active')

            $target.attr('data-active', '')
            $login.find('.login__tab[data-tab="' + tab_name + '"]').attr('data-active', '')
        }
    }


    // Dashboard

    crypto.initDashboardTabs = function(){
        if(!$('.dashboard').length) return

        const $dashboard = $('.dashboard')
        const $menu = $dashboard.find('.dashboard-menu')

        if(window.location.hash){
            makeTabActive(window.location.hash.replace('#', ''))
        }

        $menu.on('click', '.dashboard-menu-item__link', function(e){
            if($(this).attr('data-tab')){
                e.preventDefault()

                makeTabActive($(this).attr('data-tab'))

                return false
            }
        })


        function makeTabActive(tab_name){
            $dashboard.find('.dashboard-tab--active').removeClass('dashboard-tab--active')
            $dashboard.find('.dashboard-tab[data-tab="' + tab_name + '"]').addClass('dashboard-tab--active')

            $menu.find('.dashboard-menu-item--active').removeClass('dashboard-menu-item--active')
            $menu.find('.dashboard-menu-item__link[data-tab="' + tab_name + '"]').closest('.dashboard-menu-item').addClass('dashboard-menu-item--active')

            window.location.hash = tab_name
        }
    }


    // Terms

    crypto.initTermsExpanding = function(){
        if(!$('.terms-list').length) return

        const _this = this

        checkTerms()

        $(window).resize(checkTerms)
        $(window).on('termsloaded', checkTerms)

        $('.terms-list').on('click', '.term-item__readmore', function(){
            const $item = $(this).closest('.term-item')
            const $inner = $item.find('.term-item__inner')
            
            if(!$item.hasClass('term-item--expanded')){
                $item.addClass('term-item--expanded')
                $inner.css('height', $inner.attr('data-expanded-height'))
            }
            else{
                $item.removeClass('term-item--expanded')
                $inner.css('height', $inner.attr('data-initial-height'))
            }
        })

        function checkTerms(){
            $('.term-item').each(function(){
                const $inner = $(this).find('.term-item__inner')
    
                if(_this.utils.isElementOverflowing($inner)){
                    const initial_height = $(this).height()
                    const expanded_height = $inner[0].scrollHeight
    
                    $(this).addClass('term-item--expandable')
                    $inner.css('height', initial_height + 'px')
                    $inner.attr('data-initial-height', initial_height + 'px')
                    $inner.attr('data-expanded-height', expanded_height + 'px')
                }
                else{
                    if(!$(this).hasClass('term-item--expanded')){
                        $(this).removeClass('term-item--expandable')
                        $inner.css('height', '')
                    }
                    else{
                        $(this).removeClass('term-item--expanded')
                        $inner.css('height', '')
                    }
                }
            })
        }
    }


    crypto.initTermsInfiniteScroll = function(){
        if(!$('.terms-list').length) return

        let current_page = 1
        let can_be_loaded = !window.location.href.includes('?item')
        let current_char = $('input[name="current_char"]').val()

        $(window).scroll(function(){
            if($(this).scrollTop() + $(this).height() > $(document).height() - 200) loadTerms()
        })

        function loadTerms(){
            if(can_be_loaded){
                $.ajax({
                    method: 'POST',
                    url: ccpt_data.ajax_url,
                    data: {
                        'action': 'load_terms',
                        'posts': ccpt_terms_data.query_vars,
                        'page': current_page,
                        'char': current_char
                    },
                    beforeSend: function(){
                        can_be_loaded = false
                    },
                    success: function(res){
                        console.log(res)
    
                        if(res.status === 'html'){
                            current_page++
                            current_char = res.data.current_char
                            $('.terms-list').append(res.message)
    
                            $(window).trigger('termsloaded')

                            can_be_loaded = true
                        }
                        else if(res.status === 'failure'){
                            current_char = res.data.current_char
                            console.warn(res.message)
                        }
                    }
                })
            }
        }
    }


    crypto.initTermsSearch = function(){
        if(!$('.search-form').length) return

        const _this = this

        const $search = $('.search-form')
        const $input = $search.find('.input')
        const $suggestions = $search.find('.input__suggestions')

        let results_html = ''

        $search.on('input', 'input[name="search"]', _this.utils.debounce(function(e){
            const post_type = $(e.target).data('search')
            const keyword = e.target.value

            if(keyword.length > 0){
                $.ajax({
                    method: 'POST',
                    url: ccpt_data.ajax_url,
                    data: {
                        'action': 'search',
                        'post_type': post_type,
                        'keyword': keyword
                    },
                    beforeSend: function(){
                        $search.addClass('search-form--loading')
                    },
                    success: function(res){
                        $search.removeClass('search-form--loading')

                        if(res.status === 'html'){
                            results_html = res.message

                            if(res.data.have_results){
                                $input.addClass('input--suggested')
                            }
                            else{
                                $input.removeClass('input--suggested')
                            }

                            $suggestions.html(results_html)
                        }
                    }
                })
            }
            else{
                $input.removeClass('input--suggested')
            }
        }) )
    }


    // Articles

    crypto.initArticleLikes = function(){
        if(!$('.meta--likes').length) return

        const $icon = $('.meta--likes .meta__icon')
        const $value = $('.meta--likes .meta__value')

        let can_be_liked = true

        $icon.on('click', function(){
            if(can_be_liked){
                can_be_liked = false
                $value.text(parseInt($value.text()) + 1)

                $.ajax({
                    method: 'POST',
                    url: ccpt_data.ajax_url,
                    data: {
                        'action': 'like_article',
                        'post_id': ccpt_data.post_id
                    },
                    success: function(res){
                        if(res.status !== 'success'){
                            can_be_liked = true
                        }
                    }
                })
            }
        })
    }


    crypto.initArticleTerms = function(){
        if(!$('.term').length) return

        updateTooltips()

        $(window).resize(updateTooltips)

        function updateTooltips(){
            const window_height = $(window).height()
            const article_left = $('.article').offset().left
            const article_width = $('.article').width()

            $('.term').each(function(){
                const $el = $(this)

                $(this).find('.term__desc').css({
                    bottom: window_height - $el.offset().top + 'px',
                    left: article_left + 'px',
                    width: article_width + 'px'
                })

                $(this).find('.term__arrow').css({
                    left: $(this).offset().left - article_left + ($(this).width() / 2 - 6) + 'px'
                })
            })
        }
    }


    // Init

    crypto.init()
})