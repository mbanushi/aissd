<?php
// inkludimi i skripteve
function wpbootstrap_scripts_with_jquery() {
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script( 'bootstrap' );
	
	wp_enqueue_script( 'jquery-color', array('jquery') );
	wp_register_script( 'custom', get_template_directory_uri() . '/bootstrap/js/custom.js' );
	wp_enqueue_script( 'custom' );
}
add_action('wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery');

// regjistrimi i zonave sidebar per backend
function cpwpbs_register_sidebars() {
	register_sidebar(array(
		'name'          => __( 'Sidebar', 'cpwpbs' ),
		'id'            => 'sidebar',
		'description'   => __( 'Main sidebar, appearing on the right side of the content.', 'cpwpbs' ),
    'class'         => 'sidebar main-sidebar',
		'before_widget' => '<div class="widget-item">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(
		'name'          => __( 'Before Content Bar', 'cpwpbs' ),
		'id'            => 'before-content-bar',
		'description'   => __( 'A small utility bar to appear before the content. Can be used for sharing buttons, breadcrumbs etc.', 'cpwpbs' ),
    'class'         => 'sidebar before-content-bar-sidebar',
		'before_widget' => '<div class="widget-item">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	));
	register_sidebar(array(
		'name'          => __( 'Footer Links & Copyright', 'cpwpbs' ),
		'id'            => 'footer-links',
		'description'   => __( 'The bottom-most links and copyright statement.', 'cpwpbs' ),
    'class'         => 'sidebar footer-links-sidebar',
		'before_widget' => '<div class="widget-item col-sm-4">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	));
}
add_action( 'widgets_init', 'cpwpbs_register_sidebars' );

// perkthimi
load_theme_textdomain( 'cpwpbs', TEMPLATEPATH . '/languages' );

// suporti per thumbnail
add_theme_support( 'post-thumbnails', array( 'carousel-slide' ) );
	
// krijimi i post_type te ri per Slidet e karuselit ne homepage
function cpwpbs_krijo_slide_type () {
  $labels = array(
    'name'               => __( 'Slides', 'cpwpbs' ),
    'singular_name'      => __( 'Slide', 'cpwpbs' ),
    'add_new'            => __( 'Add New', 'cpwpbs' ),
    'add_new_item'       => __( 'Add New Slide', 'cpwpbs' ),
    'edit_item'          => __( 'Edit Slide', 'cpwpbs' ),
    'new_item'           => __( 'New Slide', 'cpwpbs' ),
    'all_items'          => __( 'All Slides', 'cpwpbs' ),
    'view_item'          => __( 'View Slide', 'cpwpbs' ),
    'search_items'       => __( 'Search Slides', 'cpwpbs' ),
    'not_found'          => __( 'No slides found', 'cpwpbs' ),
    'not_found_in_trash' => __( 'No slides found in Trash', 'cpwpbs' ),
    'parent_item_colon'  => '',
    'menu_name'          => __( 'Slides', 'cpwpbs'),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => 'cpwpbs_carousel_slide',
    'rewrite'            => array( 'slug' => 'slide' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 20,
    'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
  );

  register_post_type( 'carousel-slide', $args );
}
add_action( 'init', 'cpwpbs_krijo_slide_type' );

// regjistrimi i menuve per backend
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu'       => __( 'Header Menu',   'cpwpbs' ),
      'footer-menu'       => __( 'Footer Menu',   'cpwpbs' ),
			'sidebar-menu'      => __( 'Sidebar Menu',  'cpwpbs' ),
			'footer-links-menu' => __( 'Footer Links',  'cpwpbs' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );

// modifikimi i menuse sitemap ne footer per kompliance me bootstrapin
function cpwpbs_wp_nav_menu( $args = array() ) {
	static $menu_id_slugs = array();

	$defaults = array( 'menu' => '', 'container' => 'div', 'container_class' => '', 'container_id' => '', 'menu_class' => 'menu', 'menu_id' => '',
	'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth' => 0, 'walker' => '', 'theme_location' => '' );

	$args = wp_parse_args( $args, $defaults );
	/**
	 * Filter the arguments used to display a navigation menu.
	 *
	 * @since 3.0.0
	 *
	 * @param array $args Arguments from {@see wp_nav_menu()}.
	 */
	$args = apply_filters( 'wp_nav_menu_args', $args );
	$args = (object) $args;

	// Get the nav menu based on the requested menu
	$menu = wp_get_nav_menu_object( $args->menu );

	// Get the nav menu based on the theme_location
	if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
		$menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );

	// get the first menu that has items if we still can't find a menu
	if ( ! $menu && !$args->theme_location ) {
		$menus = wp_get_nav_menus();
		foreach ( $menus as $menu_maybe ) {
			if ( $menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) ) ) {
				$menu = $menu_maybe;
				break;
			}
		}
	}

	// If the menu exists, get its items.
	if ( $menu && ! is_wp_error($menu) && !isset($menu_items) )
		$menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );

	/*
	 * If no menu was found:
	 *  - Fall back (if one was specified), or bail.
	 *
	 * If no menu items were found:
	 *  - Fall back, but only if no theme location was specified.
	 *  - Otherwise, bail.
	 */
	if ( ( !$menu || is_wp_error($menu) || ( isset($menu_items) && empty($menu_items) && !$args->theme_location ) )
		&& $args->fallback_cb && is_callable( $args->fallback_cb ) )
			return call_user_func( $args->fallback_cb, (array) $args );

	if ( ! $menu || is_wp_error( $menu ) )
		return false;

	$nav_menu = $items = '';

	$show_container = false;
	if ( $args->container ) {
		/**
		 * Filter the list of HTML tags that are valid for use as menu containers.
		 *
		 * @since 3.0.0
		 *
		 * @param array The acceptable HTML tags for use as menu containers, defaults as 'div' and 'nav'.
		 */
		$allowed_tags = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );
		if ( in_array( $args->container, $allowed_tags ) ) {
			$show_container = true;
			$class = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-'. $menu->slug .'-container"';
			$id = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
			$nav_menu .= '<'. $args->container . $id . $class . '>';
		}
	}

	// Set up the $menu_item variables
	_wp_menu_item_classes_by_context( $menu_items );

	$sorted_menu_items = $menu_items_with_children = array();
	foreach ( (array) $menu_items as $menu_item ) {
		$sorted_menu_items[ $menu_item->menu_order ] = $menu_item;
		if ( $menu_item->menu_item_parent )
			$menu_items_with_children[ $menu_item->menu_item_parent ] = true;
	}

	// Add the menu-item-has-children class where applicable
	if ( $menu_items_with_children ) {
		foreach ( $sorted_menu_items as &$menu_item ) {
			if ( isset( $menu_items_with_children[ $menu_item->ID ] ) )
				$menu_item->classes[] = 'menu-item-has-children';
				$menu_item->classes[] = 'col-sm-2';
		}
	}

	unset( $menu_items, $menu_item );

	/**
	 * Filter the sorted list of menu item objects before generating the menu's HTML.
	 *
	 * @since 3.1.0
	 *
	 * @param array $sorted_menu_items The menu items, sorted by each menu item's menu order.
	 */
	$sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );

	$items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
	unset($sorted_menu_items);

	// Attributes
	if ( ! empty( $args->menu_id ) ) {
		$wrap_id = $args->menu_id;
	} else {
		$wrap_id = 'menu-' . $menu->slug;
		while ( in_array( $wrap_id, $menu_id_slugs ) ) {
			if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) )
				$wrap_id = preg_replace('#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
			else
				$wrap_id = $wrap_id . '-1';
		}
	}
	$menu_id_slugs[] = $wrap_id;

	$wrap_class = $args->menu_class ? $args->menu_class : '';

	/**
	 * Filter the HTML list content for navigation menus.
	 *
	 * @since 3.0.0
	 *
	 * @param string $items The HTML list content for the menu items.
	 * @param array $args Arguments from {@see wp_nav_menu()}.
	 */
	$items = apply_filters( 'wp_nav_menu_items', $items, $args );
	/**
	 * Filter the HTML list content for a specific navigation menu.
	 *
	 * @since 3.0.0
	 *
	 * @param string $items The HTML list content for the menu items.
	 * @param array $args Arguments from {@see wp_nav_menu()}.
	 */
	$items = apply_filters( "wp_nav_menu_{$menu->slug}_items", $items, $args );

	// Don't print any markup if there are no items at this point.
	if ( empty( $items ) )
		return false;

	$nav_menu .= sprintf( $args->items_wrap, esc_attr( $wrap_id ), esc_attr( $wrap_class ), $items );
	unset( $items );

	if ( $show_container )
		$nav_menu .= '</' . $args->container . '>';

	/**
	 * Filter the HTML content for navigation menus.
	 *
	 * @since 3.0.0
	 *
	 * @param string $nav_menu The HTML content for the navigation menu.
	 * @param array $args Arguments from {@see wp_nav_menu()}.
	 */
	$nav_menu = apply_filters( 'wp_nav_menu', $nav_menu, $args );

	if ( $args->echo )
		echo $nav_menu;
	else
		return $nav_menu;
}

// zevendesimi i [...] te excerpt-it me Read More te linkuar ne permalink
function pa_tre_pikat( $more ) {
	$permalink  = ' ... <a href="' . get_permalink( get_the_ID() ) . '">';
	$permalink .= __('Read More', 'cpwpbs');
	$permalink .= '</a> ...';
	return $permalink;
}
add_filter( 'excerpt_more', 'pa_tre_pikat' );
function custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );







?>