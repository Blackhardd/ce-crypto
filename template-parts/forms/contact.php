<?php

wp_enqueue_script( 'forms' );

?>

<form class="form form--contact">
    <div class="form__fields">
        <fieldset>
            <div class="form-row form-row--two">
                <div class="form-col">
                    <div class="input input--transparent input--required input--name">
                        <div class="input__wrap">
                            <input type="text" name="name" placeholder="<?=__( "Ім'я", 'ce-crypto' ); ?>" class="input__input">
                        </div>
                    </div>
                </div>

                <div class="form-col">
                    <div class="input input--transparent input--required input--phone">
                        <div class="input__wrap">
                            <input type="tel" name="phone" placeholder="<?=__( 'Телефон', 'ce-crypto' ); ?>" class="input__input">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="form__actions">
        <button type="submit" class="form__submit btn btn--primary"><?=__( 'Відправити', 'ce-crypto' ); ?></button>
    </div>

    <input type="hidden" name="action" value="contact">
</form>