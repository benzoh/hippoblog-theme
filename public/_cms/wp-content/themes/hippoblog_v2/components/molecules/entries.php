<?php

foreach ($args as $entry) {
  // _D($entry);

  // author取得
  $author_slug = get_the_author_meta('user_nicename');
  $author_archive_url = get_author_posts_url($author_slug) . $author_slug;
  $author = get_posts([
    'name' => $author_slug,
    'post_type' => 'profile',
  ]);

  get_template_part('components/atoms/thumbnail', null, ['post_thumbnail' => wp_get_attachment_image_src(get_post_thumbnail_id($entry), 'full')]);
  get_template_part('components/atoms/author', null, []);
  get_template_part('components/atoms/title', null, ['post_title' => $entry->post_title]);
  get_template_part('components/atoms/data', null, []);
  get_template_part('components/atoms/button', null, []);
}