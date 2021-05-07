<?php

$template = 'basic';
$component_name = 'home';

get_template_part(
  'components/templates/' . $template,
  null,
  [
    'component_name' => $component_name
  ]
);