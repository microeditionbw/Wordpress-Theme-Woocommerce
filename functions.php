<?php
/**
 * GoldenSkin functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GoldenSkin
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'goldenskin_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function goldenskin_setup() {


	// Check if the menu exists
$menu_name   = 'Menu 1';
$menu_exists = wp_get_nav_menu_object( $menu_name );
 
// If it doesn't exist, let's create it.
if ( ! $menu_exists ) {
    $menu_id = wp_create_nav_menu($menu_name);
 
    // Set up default menu items
    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'   =>  __( 'Главная', 'textdomain' ),
        'menu-item-classes' => 'home',
        'menu-item-url'     => home_url( '/' ), 
        'menu-item-status'  => 'publish'
    ) );

}

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on GoldenSkin, use a find and replace
		 * to change 'goldenskin' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'goldenskin', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'goldenskin' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'goldenskin_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'goldenskin_setup' );


function prefix_disable_comment_url($fields) { 
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','prefix_disable_comment_url');

function themename_customize_register($wp_customize){
        $wp_customize->add_setting( 'setting_welcome', array(
            'default'        => 'Добро пожаловать в цех!',
            'capability'     => 'edit_theme_options',
            'type'           => 'theme_mod',
        ));
        $wp_customize->add_control( 'test_control', array(
            'label'      => __('Заголовок', 'themename'),
            'section'    =>  'title_tagline',
            'settings'   => 'setting_welcome',
        ));
}
add_action('customize_register', 'themename_customize_register');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function goldenskin_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'goldenskin_content_width', 640 );
}
add_action( 'after_setup_theme', 'goldenskin_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function goldenskin_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'goldenskin' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'goldenskin' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'goldenskin_widgets_init' );

// Remove WP Version From Styles	
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
// Remove WP Version From Scripts
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );

// Function to remove version numbers
function sdt_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

function aj_modify_posts_per_page( $query ) {
if ( $query->is_search() ) {
$query->set( 'posts_per_page', '5' );
}
}
add_action( 'pre_get_posts', 'aj_modify_posts_per_page' );

//Change tabs position on single product page
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary',  'woocommerce_output_product_data_tabs', 30 );


/**
 * Enqueue scripts and styles.
 */
function goldenskin_scripts() {
	wp_enqueue_style('goldenskin-style', get_stylesheet_uri());
 	wp_enqueue_style('goldenskin-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');

 	
	wp_enqueue_script('jquerys', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

 	/*wp_enqueue_style('goldenskin-slick', get_template_directory_uri() . '/assets/css/slick.css');
 	wp_enqueue_style('goldenskin-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css');
 	wp_enqueue_script('custom-slick',
		get_template_directory_uri() . '/js/slick.js',
		array('jquerys')
	);*/
 	wp_enqueue_script('main-script',
		get_template_directory_uri() . '/js/main.js',
		array('jquerys')
	);
 	wp_enqueue_script('popper-script',
		get_template_directory_uri() . '/js/popper.min.js',
		array('jquerys')
	);
 	wp_enqueue_script('bootstrap-script',
		get_template_directory_uri() . '/js/bootstrap.min.js',
		array('jquerys')
	);


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'goldenskin_scripts' );

function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
  wp_deregister_script( 'wp-emoji-release' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

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


class IBenic_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
    	$object = $item->object;
    	$type = $item->type;
    	$title = $item->title;
    	$description = $item->description;
    	$permalink = $item->url;
       if($args->walker->has_children)
       {
       	$childclass = ' dropdown-toggle';
       }
      $output .= "<li class='nav-item'>";

      //Add SPAN if no Permalink
      if( $permalink && $permalink{0} != "#") {
      	$output .= '<a class="nav-link '.$childclass.'" href="' . $permalink . '">';
      } else {
      	$output .= '<a class="nav-link '.$childclass.' anchor" href="' . $permalink . '">';
      }
       
      $output .= $title;

      if( $description != '' && $depth == 0 ) {
      	$output .= '<small class="description">' . $description .'</small>';
      }

		$output .='</a>';
    }
}
 	

add_filter( 'get_search_form', 'filter_function_name_7721' );
function filter_function_name_7721( $form ){
	ob_start();
	include(locate_template('searchform.php'));
	$form = ob_get_clean();
	return $form;
}