<?php
/**
 * Photopositive functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Photopositive
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.34' );
}

if ( ! function_exists( 'photopositive_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function photopositive_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Photopositive, use a find and replace
		 * to change 'photopositive' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'photopositive', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'photopositive' ),
				'headermenu' => esc_html__( 'Header menu', 'photopositive' ),
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
				'photopositive_custom_background_args',
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
		//add_image_size( 'post_customthumb', '100%', '100%', true);
	}
endif;
add_action( 'after_setup_theme', 'photopositive_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function photopositive_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'photopositive_content_width', 640 );
}
add_action( 'after_setup_theme', 'photopositive_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function photopositive_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'photopositive' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'photopositive' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'photopositive_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function photopositive_scripts() {

	if( is_page(6) ){ // главная страница
		wp_enqueue_style( 'photopositive-index', get_template_directory_uri().'/assets/style/index.css', array(), _S_VERSION );
	}
	if( is_home() ){ // страница галереи
		wp_enqueue_style( 'photopositive-gallery', get_template_directory_uri().'/assets/style/gallery.css', array(), _S_VERSION );
	}
	if( is_page(10) ){ // страница победителей
		wp_enqueue_style( 'photopositive-projects', get_template_directory_uri().'/assets/style/projects.css', array(), _S_VERSION );
	}
	if( is_page(12) ){ // страница Личного кабинета
		wp_enqueue_style( 'photopositive-user-page', get_template_directory_uri().'/assets/style/user-page.css', array(), _S_VERSION );
	}
	if( is_single() ) { // страница отображения 1 поста
		wp_enqueue_style( 'photopositive-photo', get_template_directory_uri().'/assets/style/photo.css', array(), _S_VERSION );
	}
	if( is_404() ){ // страница 404
		wp_enqueue_style( 'photopositive-index', get_template_directory_uri().'/assets/style/index.css', array(), _S_VERSION );
	}
	if( is_archive() ){ // страница галереи
		wp_enqueue_style( 'photopositive-archive', get_template_directory_uri().'/assets/style/archive.css', array(), _S_VERSION );
	}
	wp_enqueue_style( 'photopositive-style', get_stylesheet_uri(), array(), _S_VERSION );
	/** wp_enqueue_style( 'photopositive-photo', get_template_directory_uri().'/assets/style/photo.css', array(), _S_VERSION ); */
	/** wp_enqueue_style( 'photopositive-user-page', get_template_directory_uri().'/assets/style/user-page.css', array(), _S_VERSION ); */

	wp_style_add_data( 'photopositive-style', 'rtl', 'replace' );

	wp_enqueue_script( 'photopositive-fontawesome', 'https://kit.fontawesome.com/418d1ec454.js', array(), _S_VERSION, true );
	if( is_page(6) ){  // главная страница
		wp_enqueue_script( 'photopositive-script', get_template_directory_uri() . '/assets/script/script.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'photopositive-index-line', get_template_directory_uri() . '/assets/script/index-line.js', array(), _S_VERSION, true );
	}
	if( is_home() ){  // страница галереи
		wp_enqueue_script( 'photopositive-gallery', get_template_directory_uri() . '/assets/script/gallery.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'photopositive-gallery-line', get_template_directory_uri() . '/assets/script/gallery-line.js', array(), _S_VERSION, true );
	}
	if( is_page(10) ){ // страница победителей
		wp_enqueue_script( 'photopositive-projects', get_template_directory_uri() . '/assets/script/projects.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'photopositive-projects-line', get_template_directory_uri() . '/assets/script/projects-line.js', array(), _S_VERSION, true );
	}
	if( is_page(12) ){ // страница Личного кабинета
		wp_enqueue_script( 'photopositive-user-page-gallery', get_template_directory_uri() . '/assets/script/user-page-gallery.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'photopositive-user-page-line', get_template_directory_uri() . '/assets/script/user-page-line.js', array(), _S_VERSION, true );
	}
	if( is_404() ){ // страница 404
		wp_enqueue_script( 'photopositive-script', get_template_directory_uri() . '/assets/script/script.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'photopositive-index-line', get_template_directory_uri() . '/assets/script/index-line.js', array(), _S_VERSION, true );
	}
	if( is_single() ) { // страница отображения 1 поста
		wp_enqueue_script( 'photopositive-script', get_template_directory_uri() . '/assets/script/single.js', array(), _S_VERSION, true );
	}
	if( is_archive() ) { // страница отображения 1 поста
		wp_enqueue_script( 'photopositive-script', get_template_directory_uri() . '/assets/script/archive.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'photopositive-archive-line', get_template_directory_uri() . '/assets/script/archive-line.js', array(), _S_VERSION, true );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'photopositive_scripts' );

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
function custom_comment(){

}
if ( ! current_user_can( 'manage_options' ) ) {
	show_admin_bar( false );
}
function redirect_users_after_login() {
    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;

    // Редирект для администраторов
    // if ( $roles[0] == 'administrator' ) {
    //      wp_redirect( home_url() );
    //      exit;
    // }

    // Редирект для подписчиков
    if ( $roles[0] == 'subscriber' ) {
         wp_redirect( home_url() );
         exit;
    }

    // Редирект для авторов
    if ( $roles[0] == 'author' ) {
         wp_redirect( home_url() );
         exit;
    }

    // Редирект для редакторов
    if ( $roles[0] == 'editor' ) {
         wp_redirect( home_url() );
         exit;
    }

}
add_action( 'admin_init', 'redirect_users_after_login' );
