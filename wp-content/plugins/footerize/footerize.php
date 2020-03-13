<?php
/*
Plugin Name: Footerize
Plugin URI: http://webemfoco.com.br/
Description: Plugin para inserir conteúdos no rodapé e cabeçalho dos seus posts e páginas automaticamente.
Version: 2.0
Author: Lucas Moreira
Author URI: http://lucasmoreira.com.br/
*/

function footerize_init() {

	add_option('footerize_pre_content','');
	add_option('footerize_pre_content_posts',false);
	add_option('footerize_pre_content_pages',false);
	add_option('footerize_exclude_from_pre','');

	add_option('footerize_pos_content','');
	add_option('footerize_pos_content_posts',false);
	add_option('footerize_pos_content_pages',false);
	add_option('footerize_exclude_from_pos','');

	add_option('footerize_shortcode_content','');

}
register_activation_hook( __FILE__, 'footerize_init');

function footerize_destroy() {

	delete_option('footerize_pre_content');
	delete_option('footerize_pre_content_posts');
	delete_option('footerize_pre_content_pages');
	delete_option('footerize_exclude_from_pre','');

	delete_option('footerize_pos_content');
	delete_option('footerize_pos_content_posts');
	delete_option('footerize_pos_content_pages');
	delete_option('footerize_exclude_from_pos','');

	delete_option('footerize_shortcode_content');

}
register_deactivation_hook( __FILE__, 'footerize_destroy');

function footerize_page_options(){
    add_submenu_page(
        'options-general.php',
        'Footerize',
        'Footerize',
        'manage_options',
        'footerize/options.php'
    );
}
add_action('admin_menu', 'footerize_page_options');

function footerize_content($content) {

	$pre_content = wp_kses_post( get_option('footerize_pre_content') );
	$pos_content = wp_kses_post( get_option('footerize_pos_content') );

	$exclude_pre = get_option('footerize_exclude_from_pre');
	$exclude_pos = get_option('footerize_exclude_from_pos');

	$exclude_pre = explode(',', $exclude_pre);
	$exclude_pos = explode(',', $exclude_pos);

	$the_id = get_the_ID();

	if ( is_page() ) {

		if ( get_option('footerize_pre_content_pages') == true && !in_array($the_id, $exclude_pre) )
			$content = $pre_content.'<!-- Plugin Footerize --><br><br>'.$content;

		if ( get_option('footerize_pos_content_pages') == true && !in_array($the_id, $exclude_pos) )
			$content = $content.'<br><!-- Plugin Footerize -->'.$pos_content;

	}

	if ( is_single() ) {

		if ( get_option('footerize_pre_content_posts') == true && !in_array($the_id, $exclude_pre) )
			$content = $pre_content.'<!-- Plugin Footerize --><br><br>'.$content;

		if ( get_option('footerize_pos_content_posts') == true && !in_array($the_id, $exclude_pos) )
			$content = $content.'<br><!-- Plugin Footerize -->'.$pos_content;

	}

	return $content;
}
add_filter('the_content','footerize_content');


function footerize_shortcode_filter() {

	$shortcode_content = get_option('footerize_shortcode_content');
	if ( isset($shortcode_content) && !empty($shortcode_content) )
		return wp_kses_post( $shortcode_content );
	else
		return '';

}
add_shortcode('footerize','footerize_shortcode_filter'); // [footerize]
