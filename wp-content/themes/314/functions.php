<?php
/**
 * ok functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ok
 */

if ( ! function_exists( 'ok_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ok_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ok, use a find and replace
		 * to change 'ok' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ok', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ok' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ok_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_image_size( 'mobile', 400 );
		add_image_size( 'hd-half' , 960);
		add_image_size( 'hd', 1920 );

	}
endif;
add_action( 'after_setup_theme', 'ok_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ok_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ok_content_width', 640 );
}
add_action( 'after_setup_theme', 'ok_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ok_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ok' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ok' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ok_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ok_scripts() {
	wp_enqueue_style( 'ok-google-fonts', '' );
	wp_enqueue_style( 'ok-style', get_template_directory_uri() . '/css/style.css' );

	wp_enqueue_script( 'ok-injector-svg', get_template_directory_uri() . '/js/svg-injector.min.js', array(), NULL, true );
	wp_enqueue_script( 'ok-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), NULL, true );
	wp_enqueue_script( 'ok-aos', get_template_directory_uri() . '/js/aos.min.js', array(), NULL, true );
	wp_enqueue_script( 'ok-script', get_template_directory_uri() . '/js/script.js', array('jquery'), NULL, true );

	wp_localize_script('ok-script', 'okData', array(
		'site_url' => get_site_url()
	));


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ok_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*
=====================================
	HIDE ADMIN BAR
=====================================
*/

show_admin_bar(false);


/*
==========================================
	REMOVE EDITOR FROM POST AND PAGES
==========================================
*/

add_action( 'init', function() {
remove_post_type_support( 'post', 'editor' );
remove_post_type_support( 'page', 'editor' );
}, 99);


/*
==========================================
	EXCERPT CUSTOMIZE
==========================================
*/

function kwt_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'kwt_custom_excerpt_length', 999 );


function kwt_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'kwt_excerpt_more' );


/*
==========================================
	EXCERPT CUSTOM
==========================================
*/

function my_excerpt($text, $max_length = 200, $cut_off = '...', $keep_word = true)
{
	$text = strip_tags($text);

  if(strlen($text) <= $max_length) {
    return $text;
  }

  if(strlen($text) > $max_length) {
    if($keep_word) {
      $text = substr($text, 0, $max_length + 1);

      if($last_space = strrpos($text, ' ')) {
        $text = substr($text, 0, $last_space);
        $text = rtrim($text);
        $text .=  $cut_off;
      }
    } else {
      $text = substr($text, 0, $max_length);
      $text = rtrim($text);
      $text .=  $cut_off;
    }
  }

  return $text;
}


/*
===============================
	CUSTOM PAGINATIONS
===============================
*/

function custom_pagination($loop, $prev, $next) {
	echo paginate_links( array(
      'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
      'total'        => $loop->max_num_pages,
      'current'      => max( 1, get_query_var( 'paged' ) ),
      'format'       => '?paged=%#%',
      'show_all'     => false,
      'type'         => 'plain',
      'end_size'     => 2,
      'mid_size'     => 1,
      'prev_next'    => true,
      'prev_text'    => sprintf( '<i> < </i> %1$s', __( $prev, 'text-domain' ) ),
      'next_text'    => sprintf( '%1$s <i> > </i>', __( $next, 'text-domain' ) ),
      'add_args'     => false,
      'add_fragment' => '',
  	));
}

/*
===============================
	ACF OPTION PAGES
===============================
*/

if( function_exists('acf_add_options_page') ) {


	// add parent
	$parent = acf_add_options_page(array(
		'menu_title' => '314 Theme',
		'page_title' 	=> '314 Theme',
		'position' => 3,
		'icon_url' => false,
		'redirect' => false
	));


	// add sub page
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Sekcje globalne',
		'menu_title' 	=> 'Sekcje globalne',
		'parent_slug' 	=> $parent['menu_slug'],
	));

}


/*
=====================================
	CUSTOM POST TYPES
=====================================
*/

function my_post_types() {

  // USŁUGI
   register_post_type('uslugi', array(
      'supports' => array('title'),
      'rewrite' => array('slug' => 'uslugi'),
      'has_archive' => true,
      'public' => true,
      'publicly_queryable' => true,
      'hierarchical' => false,
			'menu_position' => 20,
      'labels' => array(
         'name' => 'Usługi',
         'add_new_item' => 'Dodaj usługę',
         'edit_item' => 'Edytuj usługę',
         'all_items' => 'Wszystkie usługi',
         'singular_name' => 'Usługa',
				 'add_new' => 'Dodaj nową'
      ),
      'menu_icon' => 'dashicons-clipboard'
   ));

}

add_action('init', 'my_post_types');


/*
=====================================
	RENAME DEFAULT POSTS
=====================================
*/

function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
        $labels->name = 'Aktualności';
        $labels->singular_name = 'Aktualność';
        $labels->add_new = 'Dodaj nową';
        $labels->add_new_item = 'Dodaj nową';
        $labels->edit_item = 'Edytuj wpis';
        $labels->new_item = 'Aktualność';
        $labels->view_item = 'Zobacz wpis';
        $labels->search_items = 'Przeszukaj aktualności';
        $labels->not_found = 'Nie znaleziono';
        $labels->not_found_in_trash = 'Nie znaleziono wpisów w koszu';
        $labels->all_items = 'Wszystkie aktualności';
        $labels->menu_name = 'Aktualności';
        $labels->name_admin_bar = 'Aktualności';
}

add_action( 'init', 'cp_change_post_object' );



/*
=====================================
	MAP SHORTCODE
=====================================
*/

function pi_map_shortcode() {
$locations = get_field('lokalizacje', 'options');

// begin output buffering
ob_start();

foreach($locations as $location) {
    ?>
    <?php echo $location['map'] ?>
    <?php

    break;
}

return ob_get_clean();
}
add_shortcode( 'pimap', 'pi_map_shortcode' );



/*
=====================================
	REMOVES <P> TAGS FROM CF7
=====================================
*/

add_filter('wpcf7_autop_or_not', '__return_false');



/*
=====================================
	CONTACT FORM 7 SUPPORT
=====================================
*/

//add_filter( 'wpcf7_support_html5_fallback', '__return_true' );
