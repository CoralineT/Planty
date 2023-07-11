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
add_filter( 'wp_nav_menu_items', 'header_link_admin', 10, 2 );

function header_link_admin( $items, $args) {

	if ( is_user_logged_in()  && $args->menu->term_id == 2 ) {

		$items .= ' <li id="link-admin"><a href=" ' . admin_url() . ' ">Admin</a></li> ';

	}
	
	return $items;
}


// Hook pour modifier le Footer
add_action( 'beans_footer_prepend_markup', 'modify_footer' );

function modify_footer() {

	beans_remove_action( 'beans_footer_content');
	wp_nav_menu( array(
		'menu'   => 'Footer',
		) 
	);

}


// Modification des pages : enlever les colonnes pour un layout 100%
beans_remove_action( 'beans_breadcrumb' );

// Enelver les balises <p> des formulaires
add_filter( 'wpcf7_autop_or_not', '__return_false' );


