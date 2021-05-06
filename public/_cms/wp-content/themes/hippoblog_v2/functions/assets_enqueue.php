<?php

function theme_name_scripts()
{
	wp_enqueue_style('theme-style', get_stylesheet_uri());
	wp_enqueue_style('common-style', get_template_directory_uri() . '/_assets/css/common.css');
	wp_enqueue_script('common-script', get_template_directory_uri() . '/_assets/js/common.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), null, true);
	wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'theme_name_scripts');