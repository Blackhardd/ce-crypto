<form class="form form--login" id="form-login">
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

            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="input input--default input--required input--email">
                        <div class="input__wrap">
                            <input type="password" name="password" placeholder="<?=__( 'Пароль', 'ce-crypto' ); ?>" class="input__input">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="form__response"></div>

    <div class="form__widget">
        <div class="lost-password-trigger">
            <a href="#modal-lost-password" class="lost-password-trigger__link"><?=__( 'Забули пароль? Відновити.', 'ce-crypto' ); ?></a>
        </div>

        <?php get_template_part( 'template-parts/widgets/social-login' ); ?>
    </div>

    <div class="form__actions">
        <button type="submit" class="form__submit btn btn--primary"><?=__( 'Увійти', 'ce-crypto' ); ?></button>
    </div>

    <input type="hidden" name="action" value="login">
</form>