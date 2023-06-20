<?php

// Include Beans. Do not remove the line below.
require_once( get_template_directory() . '/lib/init.php' );

// Remove this action and callback function if you are not adding CSS in the style.css file.
add_action( 'wp_enqueue_scripts', 'beans_child_enqueue_assets' );

function beans_child_enqueue_assets() {

	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
}


// ===============
// ==== Hooks ====
// ===============

// Hook pour afficher le lien "admin" si utilisateur connecté
function header_link_admin() {

	if ( !is_user_logged_in()) {

		beans_add_attribute( 'beans_menu_item[_24]', 'class', 'hidden' );
		
	} else {
		beans_add_attribute( 'beans_menu_item_link[_24]', 'href', admin_url() );
	}

}

add_action( 'beans_header_prepend_markup', 'header_link_admin' );



// Hook pour modifier le Footer
function modify_footer() {

	beans_remove_action( 'beans_footer_content');
	wp_nav_menu( array(
		'menu'   => 'Footer',
		) 
	);

}

add_action( 'beans_footer_prepend_markup', 'modify_footer' );

