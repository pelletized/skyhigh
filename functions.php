<?php
/**
 * skyhigh functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package skyhigh
 */

if ( ! function_exists( 'skyhigh_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function skyhigh_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on skyhigh, use a find and replace
	 * to change 'skyhigh' to the name of your theme in all the template files.
	 */
	//load_theme_textdomain( 'skyhigh', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'skyhigh' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	 /*
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
	*/
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'skyhigh_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'skyhigh_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function skyhigh_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'skyhigh_content_width', 640 );
}
add_action( 'after_setup_theme', 'skyhigh_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function skyhigh_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'skyhigh' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'skyhigh_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function skyhigh_scripts() {
	wp_enqueue_style( 'skyhigh-style', get_stylesheet_uri() );

	wp_enqueue_script( 'skyhigh-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'skyhigh-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skyhigh_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//skyhigh specific
function callPaginate() {
	$paginate = '';
	if(function_exists('wp_paginate')) {
		$paginate = wp_paginate();
	}	
	
	return $paginate;
}

add_image_size( 'homepage-thumb', 300, 300, true ); 

/*
class skyhigh_products {

  function __construct() {
    add_action('init',array($this,'create_post_type'));
    add_action('init',array($this,'create_taxonomies'));
    add_action('manage_sm_project_posts_columns',array($this,'columns'),10,2);
    add_action('manage_sm_project_posts_custom_column',array($this,'column_data'),11,2);
    add_filter('posts_join',array($this,'join'),10,1);
    add_filter('posts_orderby',array($this,'set_default_sort'),20,2);
  }

  function create_post_type() {
	  $labels = array(
		'name'				 => 'Products',
		'singular_name'		 => 'Product',
		'menu_name'			 => 'Products',
		'name_admin_bar'	 => 'Product',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Product',
		'new_item'           => 'New Product',
		'edit_item'          => 'Edit Product',
		'view_item'          => 'View Product',
		'all_items'          => 'All Products',
		'search_items'       => 'Search Products',
		'parent_item_colon'  => 'Parent Product',
		'not_found'          => 'No Products Found',
		'not_found_in_trash' => 'No Products Found in Trash'	
	);
	
	
	  $args = array(
		'labels'              => $labels,
		'public'              => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-admin-appearance',
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor'),
		'has_archive'         => true,
		'with_front'          => true,
		'rewrite'             => array( 'slug' => 'products' ),
		'query_var'           => true
	  );
	  
	  register_post_type( 'skyhigh_products', $args );    
  }

  function create_taxonomies() {
	   // Add a taxonomy like categories
	  $labels = array(
		'name'              => 'Types',
		'singular_name'     => 'Type',
		'search_items'      => 'Search Types',
		'all_items'         => 'All Types',
		'parent_item'       => 'Parent Type',
		'parent_item_colon' => 'Parent Type:',
		'edit_item'         => 'Edit Type',
		'update_item'       => 'Update Type',
		'add_new_item'      => 'Add New Type',
		'new_item_name'     => 'New Type Name',
		'menu_name'         => 'Types',
	  );

	  $args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'type' ),
	  );

	  register_taxonomy('skyhigh_product_type',array('skyhigh_products'),$args);

	  // Add a taxonomy like tags
	  $labels = array(
		'name'                       => 'Attributes',
		'singular_name'              => 'Attribute',
		'search_items'               => 'Attributes',
		'popular_items'              => 'Popular Attributes',
		'all_items'                  => 'All Attributes',
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => 'Edit Attribute',
		'update_item'                => 'Update Attribute',
		'add_new_item'               => 'Add New Attribute',
		'new_item_name'              => 'New Attribute Name',
		'separate_items_with_commas' => 'Separate Attributes with commas',
		'add_or_remove_items'        => 'Add or remove Attributes',
		'choose_from_most_used'      => 'Choose from most used Attributes',
		'not_found'                  => 'No Attributes found',
		'menu_name'                  => 'Attributes',
	  );

	  $args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'attribute' ),
	  );

	  register_taxonomy('skyhigh_product_attribute','skyhigh_products',$args);
	  
    
  }

  function columns($columns) {
    
  }

  function column_data($column,$post_id) {
    
  }

  function join($wp_join) {
    
  }

  function set_default_sort($orderby,&$query) {
    
  }
}
*/
//new skyhigh_products();