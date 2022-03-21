<?php

// Get style from Parent Theme
add_action( 'wp_enqueue_scripts', 'camp_theme_enqueue_styles', PHP_INT_MAX );

function camp_theme_enqueue_styles()
{
    $parent_style = 'eventstar-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        [$parent_style],
        wp_get_theme()->get('Version')
    );
}

// Include custom script
add_action( 'wp_enqueue_scripts', 'camp_theme_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'camp_theme_enqueue_scripts' );

function camp_theme_enqueue_scripts()
{
    wp_enqueue_media();
    wp_enqueue_script( 'child-custom-script', get_stylesheet_directory_uri() . '/js/custom-script.js', ['jquery'], '1.0', true );
}

function enqueue_accordion_script()
{
    if ( ! is_admin() && is_page_template( $template = 'template-accordion.php' ) ) {
        wp_enqueue_script( 'jquery-ui-accordion' );
        wp_enqueue_script( 'custom-accordion', get_stylesheet_directory_uri() . '/js/accordion.js', ['jquery'] );
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_accordion_script' );

// Add Google Font
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

function add_google_fonts()
{
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Siemreap', false );
}

// Load Theme's Translated Link
add_action( 'after_setup_theme', 'ictcamp_theme_setup' );
function ictcamp_theme_setup()
{
    load_theme_textdomain( 'event-star', get_stylesheet_directory() . '/i18n/parent-language' );
    load_child_theme_textdomain( 'ict_camp', get_stylesheet_directory() . '/i18n' );
}

// Widget
add_action( 'widgets_init', 'register_camp_widgets' );

function register_camp_widgets()
{
    register_widget( 'Camp_Themes_Widget' );
    register_widget( 'Camp_Organizers_Widget' );
}

require_once( __DIR__ . '/widgets/camp-posts-no-img.php' );
require_once( __DIR__ . '/widgets/camp-themes.php' );
require_once( __DIR__ . '/widgets/camp-organizers.php' );

// Register Hooks
require_once( __DIR__ . '/hooks/excerpts.php' );
require_once( __DIR__ . '/hooks/header.php' );
require_once( __DIR__ . '/hooks/footer.php' );
require_once( __DIR__ . '/hooks/pagination.php' );
require_once( __DIR__ . '/hooks/slider-selection.php' );

// Register Custom Taxonomies
require_once( __DIR__ . '/inc/custom-taxonomies/facilitator-groups.php' );
require_once( __DIR__ . '/inc/custom-taxonomies/session-types.php' );
require_once( __DIR__ . '/inc/custom-taxonomies/years.php' );

// Register Custom Post Types
require_once( __DIR__ . '/inc/custom-post-types/announcements.php' );
require_once( __DIR__ . '/inc/custom-post-types/donors.php' );
require_once( __DIR__ . '/inc/custom-post-types/facilitators.php' );
require_once( __DIR__ . '/inc/custom-post-types/organizers.php' );
require_once( __DIR__ . '/inc/custom-post-types/partners.php' );
require_once( __DIR__ . '/inc/custom-post-types/sessions.php' );
require_once( __DIR__ . '/inc/custom-post-types/presentations.php');
require_once( __DIR__ . '/inc/custom-post-types/speakers.php' );

// Register Custom Meta Boxes for Facilitator post type
require_once( __DIR__ . '/inc/custom-meta-boxes/facilitators/expertise.php' );
require_once( __DIR__ . '/inc/custom-meta-boxes/facilitators/organization.php' );
require_once( __DIR__ . '/inc/custom-meta-boxes/facilitators/social-media-links.php' );

// Register Custom Meta Boxes for Session post type
require_once( __DIR__ . '/inc/custom-meta-boxes/sessions/hall.php' );
require_once( __DIR__ . '/inc/custom-meta-boxes/sessions/time.php' );

// Register Custom Meta Boxes for Speaker post type
require_once( __DIR__ . '/inc/custom-meta-boxes/speakers/expertise.php' );
require_once( __DIR__ . '/inc/custom-meta-boxes/speakers/organization.php' );
require_once( __DIR__ . '/inc/custom-meta-boxes/speakers/social-media-links.php' );

// Register Custom Meta Boxes for all post types
require_once( __DIR__ . '/inc/custom-meta-boxes/custom-link.php' );

// Register Custom Form Fields for Taxonomy
require_once( __DIR__ . '/inc/taxonomy-form-fields/categories/colors.php' );
require_once( __DIR__ . '/inc/taxonomy-form-fields/categories/images.php' );

// Util Content
require_once( __DIR__ . '/inc/utils-content.php' );

// Language Management
require_once( __DIR__ . '/inc/localize-manager.php' );

// Shortcode
require_once( __DIR__ . '/inc/shortcode/display-custom-post-type.php' );

/**
 * Custom trim excerpt with Khmer text support, using regular expression. Khmer
 * text must contain zero-width spaces (ZWSP); otherwise, this code can not
 * detect the word boundaries. There is another way to do it with ICU library,
 * but it needs some server configuartions which is not usually available in
 * most shared hosting.
 *
 * @author Tep Sovichet (http://sovichet.info)
 * @param  string $text
 * @return mixed
 */
function trim_excerpt_khmer( $text )
{
    $raw_excerpt = $text;

    if ( '' == $text ) {
        $original_content = wp_strip_all_tags( get_the_content( '' ) );

        $text = $original_content;
        $text = strip_shortcodes( $text );
        $text = apply_filters( 'the_content', $text );
        $text = str_replace(']]', ']]&gt', $text);

        $excerpt_length = apply_filters( 'excerpt_length', 42 );
        $excerpt_more = apply_filters( 'excerpt_more', ' ', '[&hellip;]' );

        $text = wp_trim_words( $text, $excerpt_length, '' );

        $regex = "/[$-\/:-?{-~!\"^_`[\]\w\d\xE1\x9E\x80-\xE1\x9F\xBF]+[\xE2\x80\x8B \xE1\x9F\x94\xE1\x9F\x95]?/u";
        preg_match_all( $regex, $text, $matches );

        $sliced = array_slice( $matches[0], 0, $excerpt_length );
        $text = implode( '', $sliced );

        if ( strlen( $text ) < strlen( $original_content ) ) {
            $text .= $excerpt_more;
        }
    }

    return apply_filters( 'trim_excerpt_khmer', $text, $raw_excerpt );
}

remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'trim_excerpt_khmer' );
