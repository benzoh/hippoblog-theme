<?php

function _enq_assets()
{
  wp_enqueue_style('common-style', get_template_directory_uri() . '/_assets/css/index.css');
  wp_enqueue_script('common-script', get_template_directory_uri() . '/_assets/js/common.js', array('jquery'), '1.0.0', true);
}

// add_action('wp_enqueue_scripts', '_enq_assets');
