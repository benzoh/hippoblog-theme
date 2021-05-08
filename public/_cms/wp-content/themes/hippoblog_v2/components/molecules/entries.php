<?php

foreach ($args as $entry) {
  // _D($entry);
  // exit;

  // author取得
  $author = [];
  $author['slug'] = get_the_author_meta('user_nicename', $entry->post_author);
  $author['profile'] = get_posts([
    'name' => $author['slug'],
    'post_type' => 'profile',
  ]);

  get_template_part('components/atoms/thumbnail', null, ['post_thumbnail' => wp_get_attachment_image_src(get_post_thumbnail_id($entry), 'full')]);
  get_template_part('components/atoms/author', null, $author);
  get_template_part('components/atoms/title', null, ['post_title' => $entry->post_title]);
  get_template_part('components/atoms/date', null, ['post_date' => $entry->post_date]);
}