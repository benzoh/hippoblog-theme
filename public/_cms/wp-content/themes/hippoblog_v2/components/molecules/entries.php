<?php

foreach ($args as $entry) {
  // _D($entry);

  get_template_part('components/atoms/thumbnail', null, []);
  get_template_part('components/atoms/title', null, ['post_title' => $entry->post_title]);
  get_template_part('components/atoms/data', null, []);
  get_template_part('components/atoms/button', null, []);
}