jQuery(document).ready(function($){
    const name_regex = /^[A-Za-zА-ЯҐЄІЇа-яґєії0-9]{3,30}$/
    const email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    const password_regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/
    const twitter_regex = /^@?(\w){1,15}$/
    const telegram_regex = /^(?=\w{5,32}\b)[a-zA-Z0-9]+(?:_[a-zA-Z0-9]+)*.*/

    const $forms = $('.form')

    $forms.on('submit', function(e){
        e.preventDefault()

        if(validateForm($(this))) sendForm($(this))

        return false
    })

    $forms.on('input', '.input__input', function(){
        if(!$(this).closest('.input').hasClass('input--touched')){
            $(this).closest('.input').addClass('input--touched')
        }

        validateField($(this))
    })

    function validateForm($form){
        let is_valid = true

        const $fields = $form.find('input[type="text"],input[type="email"],input[type="tel"],input[type="password"]')

        $fields.each(function(){
            if(!validateField($(this))) is_valid = false
        })

        return is_valid
    }

    function validateField($field){
        let is_valid = true

        if(!validateRequired($field)) return false

        switch ($field.attr('type')){
            case 'text':
                switch ($field.attr('name')){
                    case 'name':
                    case 'first_name':
                    case 'last_name':
                        if(!validateName($field)) is_valid = false
                        break
                    case 'twitter':
                        if(!validateTwitter($field)) is_valid = false
                        break
                    case 'telegram':
                        if(!validateTelegram($field)) is_valid = false
                        break
                    default:
                        break
                }
                break
            case 'email':
                if(!validateEmail($field)) is_valid = false
                break
            case 'tel':
                if(!validatePhone($field)) is_valid = false
                break
            case 'password':
                if(!validatePassword($field)) is_valid = false
                if($field.attr('name') === 'password_repeat' && !validatePasswordRepeat($field, $field.closest('.form').find('input[name="password"]'))) is_valid = false
                break
            default:
                break
        }

        return is_valid
    }

    function sendForm($form){
        let fd = new FormData($form[0])

        $.ajax({
            method: 'POST',
            url: ccpt_forms_data.ajax_url,
            data: fd,
            contentType: false,
            processData: false,
            beforeSend: function(){
                if($form.attr('id')){
                    let form_title = $form.attr('id').replace('form-', '')
                    console.log(`${form_title.charAt(0).toUpperCase() + form_title.slice(1)} form will be sent now.`)
                }

                $form.addClass('form--loading')
                $form.find('button[type="submit"]').addClass('btn--loading')
            },
            success: function(res){
                $form.removeClass('form--loading')
                $form.find('button[type="submit"]').removeClass('btn--loading')

                const $response = $form.find('.form__response')

                switch (res.status){
                    case 'redirect':
                        window.location = res.message
                        break
                    case 'error':
                        $form.addClass('form--failed')
                        $response.html(res.message)
                        break
                    case 'success':
                        $form.addClass('form--success')
                        $response.html(res.message)
                        break
                    default:
                        console.log(res.message)
                        break
                }
            }
        })
    }


    // Validation functions

    function displayValidationError(status, message, $element = null){
        const $input = $element.closest('.input')

        $input.removeClass(['input--error', 'input--valid'])

        if(!status){
            console.warn(`Field not valid: ${$element.attr('name')}`, message)

            $input.addClass('input--error')
        }
        else{
            if($input.hasClass('input--touched')){
                $input.addClass('input--valid')
            }
        }

        return status
    }

    function validateRequired($field){
        return displayValidationError(
            $field.closest('.input').hasClass('input--required') && $field.val() === '' ? false : true,
            'Field is required.',
            $field
        )
    }

    function validateName($field){
        return displayValidationError(
            $field.val() === '' ? true : $field.val().match(name_regex),
            'Not valid name format.',
            $field
        )
    }

    function validateEmail($field){
        return displayValidationError(
            $field.val() === '' ? true : $field.val().match(email_regex),
            'Email format is not valid.',
            $field
        )
    }

    function validatePhone($field){
        return displayValidationError(
            $field.val() === '' ? true : $field.val().length === 17,
            'Phone format is not valid.',
            $field
        )
    }

    function validatePassword($field){
        return displayValidationError(
            $field.val() === '' ? true : $field.val().match(password_regex),
            'Password format is not valid.',
            $field
        )
    }

    function validatePasswordRepeat($field, $repeatField){
        return displayValidationError(
            $field.val() === '' ? true : $field.val() === $repeatField.val(),
            'Password repeat is not match.',
            $field
        )
    }

    function validateTwitter($field){
        return displayValidationError(
            $field.val() === '' ? true : $field.val().match(twitter_regex),
            'Twitter username is not valid.',
            $field
        )
    }

    function validateTelegram($field){
        return displayValidationError(
            $field.val() === '' ? true : $field.val().match(telegram_regex),
            'Telegram username is not valid.',
            $field
        )
    }
})