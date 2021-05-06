<?php

include_once dirname(__FILE__) . '/functions/assets_enqueue.php';
include_once dirname(__FILE__) . '/functions/post_type.php';

include_once dirname(__FILE__) . '/libs/debug.php';
include_once dirname(__FILE__) . '/libs/sns.php';

function _get_page_component($component_name)
{
  get_template_part('components/pages/' . $component_name);
}