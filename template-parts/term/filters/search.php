<div class="filter filter--search">
    <div class="filter__title">
        <?=__( 'Пошук терміну', 'ce-crypto' ); ?>
    </div>
    
    <div class="filter__content">
        <form class="search-form search-form--terms">
            <div class="input input--default input--search">
                <div class="input__wrap">
                    <input type="search" name="search" <?=isset( $_GET['search'] ) ? "value='{$_GET['search']}'" : ''; ?> placeholder="<?=__( 'Термін', 'ce-crypto' ); ?>" class="input__input">
                </div>
            </div>
            
            <button type="submit" class="btn btn--primary search-form__submit"><?=__( 'Пошук', 'ce-crypto' ); ?></button>
        </form>
    </div>
</div>