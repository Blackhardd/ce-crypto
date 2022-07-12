<?php

wp_enqueue_script( 'forms' );

$profile = ccpt_get_current_user_profile();

?>

<form class="form form--profile" id="form-profile">
    <div class="form__fields">
        <fieldset>
            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="image-picker">
                        <label class="image-picker__label">
                            <div class="image-picker__dimmer">
                                <?=ccpt_get_icon( 'image-picker' ); ?>
                            </div>

                            <?php if( $profile['avatar'] && $avatar_url = wp_get_attachment_image_url( $profile['avatar'], 'thumbnail' ) ) : ?>
                                <img src="<?=$avatar_url; ?>" class="image-picker__preview">
                            <?php else : ?>
                                <?=ccpt_get_avatar_placeholder_image( ['image-picker__preview'] ); ?>
                            <?php endif; ?>

                            <input type="file" accept="image/png, image/jpeg" name="avatar" class="image-picker__input">
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="input input--default input--required input--full-name">
                        <label class="input__label" for="profile-full-name"><?=__( "Ім'я та прізвище", 'ce-crypto' ); ?></label>

                        <div class="input__wrap">
                            <input type="text" name="full_name" placeholder="<?=__( "Введіть ваше ім'я", 'ce-crypto' ); ?>" value="<?=$profile['full_name']; ?>" class="input__input" id="profile-full-name">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="input input--default input--required input--email">
                        <label class="input__label" for="profile-email"><?=__( 'Електронна адреса', 'ce-crypto' ); ?></label>

                        <div class="input__wrap">
                            <input type="email" name="email" placeholder="<?=__( 'Введіть ваш email', 'ce-crypto' ); ?>" value="<?=$profile['email']; ?>" class="input__input" id="profile-email">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="input input--default input--phone">
                        <label class="input__label" for="profile-phone"><?=__( 'Номер телефону', 'ce-crypto' ); ?></label>

                        <div class="input__wrap">
                            <input type="tel" name="phone" placeholder="<?=__( 'Введіть ваш номер телефону', 'ce-crypto' ); ?>" value="<?=$profile['phone']; ?>" class="input__input" id="profile-phone">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row form-row--one">
                <div class="form-col">
                    <div class="input input--default input--password">
                        <label class="input__label" for="profile-password"><?=__( 'Пароль', 'ce-crypto' ); ?></label>

                        <div class="input__wrap">
                            <input type="password" name="password" placeholder="<?=__( 'Введіть новий пароль', 'ce-crypto' ); ?>" class="input__input" id="profile-password">

                            <button type="button" class="input__button"><?=ccpt_get_icon( 'input/password-toggle' ); ?></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row form-row--two">
                <div class="form-col">
                    <div class="input input--underline input--twitter">
                        <label for="register-twitter" class="input__label"><?=__( 'Twitter Username', 'ce-crypto' ); ?></label>

                        <div class="input__wrap">
                            <input type="text" name="twitter" placeholder="@" value="<?=$profile['twitter']; ?>" class="input__input" id="register-twitter">
                        </div>
                    </div>
                </div>

                <div class="form-col">
                    <div class="input input--underline input--telegram">
                        <label for="register-twitter" class="input__label"><?=__( 'Telegram Username', 'ce-crypto' ); ?></label>

                        <div class="input__wrap">
                            <input type="text" name="telegram" placeholder="@" value="<?=$profile['telegram']; ?>" class="input__input" id="register-telegram">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="form__response"></div>

    <div class="form__actions">
        <button type="submit" class="form__submit btn btn--primary"><?=__( 'Зберегти всі зміни', 'ce-crypto' ); ?></button>
    </div>

    <input type="hidden" name="action" value="save_profile">
</form>