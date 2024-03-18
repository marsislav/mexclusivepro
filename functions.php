<?php
/*
 *
 * mExclusive2 functions and definitions
 *@link https://developer.wordpress.org/themers/basivs/theme-functions
 * @package mExclusive2
 */
require_once('functions/dynamic-meta.php');
require_once ('functions/class-wp-bootstrap-navwalker.php');
require_once ('functions/customizer.php');

  function mexclusive2_scripts(){
      wp_register_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css');
      wp_enqueue_style( 'bootstrap' );




	  wp_register_style( 'fontAwsome', get_template_directory_uri().'/assets/css/fa.css');
	  wp_enqueue_style( 'fontAwsome' );

      wp_register_style( 'mexclusive2_style', get_template_directory_uri().'/assets/css/style.css');
      wp_enqueue_style( 'mexclusive2_style' );

}

//Scripts

wp_register_script( 'bootstrap',get_template_directory_uri().'/assets/js/bootstrap.bundle.min.js', array('jquery'), false, true );
wp_register_script( 'mexclusive2-js',get_template_directory_uri().'/assets/js/app.js', array('jquery'), false, true );



wp_enqueue_script( 'jquery' );

wp_enqueue_script( 'bootstrap');
wp_enqueue_script('mexclusive2-js');





add_action( 'wp_enqueue_scripts', 'mexclusive2_scripts' );

//Menus

function mexclusive2_config()
{
    register_nav_menus(
        array(
            'main_menu' => 'Main Menu',
            'footer_menu' => 'Footer Menu',

        )
    );
    //Woocommerce compatible
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 150,
        'single_image_width' => 300,

        'product_grid' => array(
            'default_rows' => 3,
            'min_rows' => 2,
            'max_rows' => 8,
            'default_columns' => 4,
            'min_columns' => 4,
            'max_columns' => 4,
        ),
    ));
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('custom-logo', array ( 'height' => 85, 'width' => 180, 'flex-height' => true, 'flex-width' => true, ) );
    if (!isset($content_width)) {
        $content_width=600;
    }
    add_image_size('mexclusive2-slider', 1920, 800, array(
        'center','center'
));
}

add_action('after_setup_theme', 'mexclusive2_config',0);

//WooCommerce
if (class_exists('WooCommerce')){
add_action ('woocommerce_after_shop_loop_item_title','the_excerpt', 1);/**



	 * Show cart contents / total Ajax	 */
	add_filter( 'woocommerce_add_to_cart_fragments', 'mexclusive2_woocommerce_header_add_to_cart_fragment' );

	function mexclusive2_woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		?>
		<span class="items"><?php echo WC()->cart->get_cart_contents_count(); ?> </span>
		<?php
		$fragments['span.items'] = ob_get_clean();
		return $fragments;
	}
}



