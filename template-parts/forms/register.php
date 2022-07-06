<form class="form form--register" id="form-register">
    <div class="form__fields">
        <fieldset>
            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="input input--default input--required input--name">
                        <div class="input__wrap">
                            <input type="text" name="first_name" placeholder="<?=__( "Ім'я", 'ce-crypto' ); ?>" class="input__input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="input input--default input--required input--name">
                        <div class="input__wrap">
                            <input type="text" name="last_name" placeholder="<?=__( 'Прізвище', 'ce-crypto' ); ?>" class="input__input">
                        </div>
                    </div>
                </div>
            </div>
            
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
                    <div class="input input--default input--required input--password">
                        <div class="input__wrap">
                            <input type="password" name="password" placeholder="<?=__( 'Пароль', 'ce-crypto' ); ?>" class="input__input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="input input--default input--required input--password">
                        <div class="input__wrap">
                            <input type="password" name="password_repeat" placeholder="<?=__( 'Повторний пароль', 'ce-crypto' ); ?>" class="input__input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="input input--underline input--twitter">
                        <label for="register-twitter" class="input__label"><?=__( 'Twitter Username', 'ce-crypto' ); ?></label>

                        <div class="input__wrap">
                            <input type="text" name="twitter" placeholder="@" class="input__input" id="register-twitter">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="input input--underline input--telegram">
                        <label for="register-twitter" class="input__label"><?=__( 'Telegram Username', 'ce-crypto' ); ?></label>

                        <div class="input__wrap">
                            <input type="text" name="telegram" placeholder="@" class="input__input" id="register-telegram">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="form__response"></div>

    <div class="form__widget">
        <?php get_template_part( 'template-parts/widgets/social-login' ); ?>
    </div>

    <div class="form__actions">
        <button type="submit" class="form__submit btn btn--primary"><?=__( 'Зареєструватися', 'ce-crypto' ); ?></button>
    </div>

    <input type="hidden" name="action" value="register">
</form>