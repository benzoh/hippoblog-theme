<section class="entries">

  <?php

  foreach ($args as $index => $entry) {
    // _D($entry);
    // exit;
    $first = $index === array_key_first($args) ? true : false;

    // author取得
    $author = [];
    $author['slug'] = get_the_author_meta('user_nicename', $entry->post_author);
    $author['profile'] = get_posts([
      'name' => $author['slug'],
      'post_type' => 'profile',
    ]);
  ?>

  <a class="entries__item <?php echo $first ? 'first' : 'not_first'; ?>"
    href="<?php echo get_the_permalink($entry); ?>">
    <div class="entries__img">
      <?php get_template_part('components/atoms/thumbnail', null, ['post_thumbnail' =>
        wp_get_attachment_image_src(get_post_thumbnail_id($entry), 'full')]); ?>
    </div>
    <div class="entries__data">
      <?php get_template_part('components/atoms/author', null, $author); ?>
      <?php get_template_part('components/atoms/title', null, ['post_title' => $entry->post_title]); ?>
      <?php get_template_part('components/atoms/date', null, ['post_date' => $entry->post_date]); ?>
    </div>
  </a>

  <?php
  }
  ?>

  <div class="see-more w-100 mt-4 mb-5">
    <a class="btn" href="#TODO: 記事ロード">もっと見る</a>
  </div>



</section>