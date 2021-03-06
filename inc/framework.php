<?php

/**
 * Framework functions
 * 
 * @since 1.0.0
 * @package CeCrypto
 */

if( !defined( 'ABSPATH' ) )
    exit;


/**
 * Get theme icon asset.
 * 
 * @param string $icon
 * @param string[] $classes
 * @return string
 */
function ccpt_get_icon( $icon, $classes = [] ){
    $path = CCPT_THEME_PATH . '/assets/icons/' . $icon . '.svg';

    if( file_exists( $path ) ){
        $contents = file_get_contents( $path );

        if( $classes ){
            $classes_str = implode( ' ', $classes );

            $contents = str_replace( '<svg ', "<svg class='{$classes_str}' ", $contents );
        }

        return $contents;
    }

    return false;
}


/**
 * Get theme image asset URL.
 * 
 * @param string $image
 * @return string
 */
function ccpt_get_image_url( $image ){
    $path = CCPT_THEME_PATH . '/assets/img/' . $image;

    if( file_exists( $path ) ){
        return CCPT_THEME_URI . '/assets/img/' . $image;
    }

    return false;
}


/**
 * Get avatar placeholder image tag.
 * 
 * @return string
 */
function ccpt_get_avatar_placeholder_image( $classes = [] ){
    $placeholder_url = ccpt_get_image_url( 'avatar-placeholder.jpg' );
    $classes_str = implode( ' ', $classes );

    return "<img src='{$placeholder_url}' width='150' height='150' class='{$classes_str}'/>";
}


/**
 * Minify CSS.
 * 
 * @param string $css
 * @return string
 */
function ccpt_minify_css( $css ){
    if( trim( $css ) === '' )
        return $css;

    return preg_replace(
        [
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
            '#(?<=[\s:,\-])0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
        ],
        [
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2'
        ],
        $css
    );
}


/**
 * Get article card template.
 * 
 * @param integer|string|WP_Post $article
 */
function ccpt_get_article_card_template( $article, $size = 'small' ){
    if( is_integer( $article ) || is_string( $article ) ){
        $article = get_post( $article );
    }

    if( is_null( $article ) )
        return false;
    
    get_template_part( 'template-parts/article/card', null, array(
        'article'   => $article,
        'size'      => $size
    ) );
}


/**
 * Get terms alphabet separator template.
 * 
 * @param string $letter
 */
function ccpt_get_terms_separator_template( $letter ){
    if( !$letter )
        return '';

    get_template_part( 'template-parts/term/alphabet-separator', null, array( 'letter' => $letter ) );
}


/**
 * Get term item template.
 * 
 * @param string $letter
 */
function ccpt_get_term_template(){
    get_template_part( 'template-parts/term/item' );
}


/**
 * Get progress circle template.
 * 
 * @param string|integer $progress
 * @param string|integer $radius
 */
function ccpt_get_progress_circle_template( $progress, $diameter = 44 ){
    $radius = $diameter / 2;
    $circumference = 3.14 * $radius;
    
    ?>

    <svg width="<?=$diameter; ?>" height="<?=$diameter; ?>">
        <circle r="<?=$radius; ?>" cx="<?=$radius; ?>" cy="<?=$radius; ?>" fill="#E8E8E8" stroke-width="0"></circle>
        <circle r="<?=$radius / 2; ?>" cx="<?=$radius; ?>" cy="<?=$radius; ?>" fill="none" stroke-width="<?=$radius; ?>" stroke-dasharray="<?=$circumference; ?>" stroke-dashoffset="<?=$circumference * ( ( 100 - $progress ) / 100 ); ?>" style="transform: rotateZ(-90deg); transform-origin: center;"></circle>
    </svg>

    <?php
}


/**
 * Get Google authorization URL.
 * 
 * @return string|boolean
 */
function ccpt_get_google_auth_link(){
    if( !class_exists( 'CCPT_Google_Auth' ) )
        return false;

    return CCPT_Google_Auth::get_auth_url();
}


/**
 * Get forst character from string.
 * 
 * @param string $string
 * @return string|boolean
 */
function ccpt_get_string_first_char( $string ){
    if( !is_string( $string ) )
        return false;

    return mb_substr( $string, 0, 1 );
}