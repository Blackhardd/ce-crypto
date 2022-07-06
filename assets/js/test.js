jQuery(document).ready(function($){
    const $form = $('.test__form')
    const $user_answers = $form.find('input[name="answers"]')
    const $submit = $('.test__submit')

    const questions_count = parseInt($form.find('input[name="count"]').val())

    let user_answers = []

    $form.on('change', function(){
        parse_user_answers()
        maybe_toggle_submit_button()
    })

    $submit.on('click', function(){
        $form.submit()
    })

    function maybe_toggle_submit_button(){
        $submit.prop('disabled', !(user_answers.filter(val => typeof val !== 'null').length === questions_count))
    }

    function parse_user_answers(){
        const answers = []

        $form.find('input[type="checkbox"],input[type="radio"]').each(function(){
            if($(this).is(':checked')){
                const index = $(this).attr('name').replace('question-', '')

                if(answers[index] && Array.isArray(answers[index])){
                    answers[index].push(parseInt($(this).val()))
                }
                else{
                    answers[index] = [parseInt($(this).val())]
                }
            }
        })

        user_answers = answers
        $user_answers.val(JSON.stringify(user_answers))
    }
})