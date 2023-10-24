<?php
/**
 * Nandan Global Theme Customizer
 *
 * @package Nandan_Global
 */

/**
 * Adding custom image sizes 
*/
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'favicon_img_size', 32, 32 );
}


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nandanglobal_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'nandanglobal_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'nandanglobal_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'nandanglobal_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function nandanglobal_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function nandanglobal_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nandanglobal_customize_preview_js() {
	wp_enqueue_script( 'nandanglobal-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'nandanglobal_customize_preview_js' );

/**
 * Enqueue Scripts & Style for themes
 */
function ng_enqueue_style_scripts_files() {

	/* Adding Style */
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');

	/* Adding Script */
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'ng_enqueue_style_scripts_files' );



/**
 * Navigation Menu
 */
function register_nav_menu_location(){
    register_nav_menus(
        array(
            'main' => __( 'Main Menu', 'nandanglobal' ),
        )
    );
}
add_action( 'after_setup_theme', 'register_nav_menu_location' );


/**
 * Custom Menu Naviation
 */
class NG_Nav_Menu_Walker_Simple extends Walker_Nav_Menu
{
	/**
	 * Start the element output.
	 *
	 * @param  string $output Passed by reference. Used to append additional content.
	 * @param  object $item   Menu item data object.
	 * @param  int $depth     Depth of menu item. May be used for padding.
	 * @param  array $args    Additional strings.
	 * @return void
	 */
	public function start_el( &$output, $item, $depth = 0, $args=[], $current_object_id = 0 )
	{
		$output     .= '<li class="nav-item">';
		$attributes  = '';

		! empty ( $item->attr_title )
			// Avoid redundant titles
			and $item->attr_title !== $item->title
			and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';

		! empty ( $item->url )
			and $attributes .= ' href="' . esc_attr( $item->url ) .'"';

		$image_obj = get_field('menu_image', $item->ID);
		$image_url = $image_obj['sizes']['favicon_img_size'];

		$class_names = in_array("current_page_item",$item->classes) ? ' active' : '';

		$attributes  = trim( $attributes );
		$title       = apply_filters( 'the_title', $item->title, $item->ID );
		$item_output = "$args->before<a class='nav-link $class_names' $attributes>
						<img src='$image_url' class='img-thumbnail d-block m-auto'>$args->link_before$title</a>"
						. "$args->link_after$args->after";

		// Since $output is called by reference we don't need to return anything.
		$output .= apply_filters(
			'walker_nav_menu_start_el'
			,   $item_output
			,   $item
			,   $depth
			,   $args
		);
	}

	/**
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	public function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= '<ul>';
	}

	/**
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	public function end_lvl( &$output, $depth = 0, $args = array()) {
		$output .= '</ul>';
	}

	/**
	 * @see Walker::end_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	function end_el( &$output, $category, $depth = 0, $args = array()) {
		$output .= '</li>';
	}
}