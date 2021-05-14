<?php

$template = 'basic';
$component_name = 'home';

if (is_page() || is_single()) {
  $component_name = 'single';
}

if (is_archive() || is_search()) {
  $component_name = 'archive';
}

if (is_404()) {
  $component_name = '404';
}

// var_dump($component_name);
// exit;

get_template_part(
  'components/templates/' . $template,
  null,
  [
    'component_name' => $component_name
  ]
);