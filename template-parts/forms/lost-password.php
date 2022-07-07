<form class="form form--lost-password" id="form-lost-password">
    <div class="form__fields">
        <fieldset>
            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="input input--default input--required input--email">
                        <div class="input__wrap">
                            <input type="email" name="email" placeholder="<?=__( 'Email', 'ce-crypto' ); ?>" class="input__input">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="form__response"></div>

    <div class="form__actions">
        <button type="submit" class="form__submit btn btn--primary"><?=__( 'Отримати тимчасовий пароль', 'ce-crypto' ); ?></button>
    </div>

    <input type="hidden" name="action" value="lost_password">
</form>