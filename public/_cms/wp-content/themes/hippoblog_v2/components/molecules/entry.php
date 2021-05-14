<?php
$entry = $args ?? $post;
?>

<div class="entry">

  <div class="entry__img">
    <?php get_template_part('components/atoms/thumbnail', null, ['post_thumbnail' =>
    wp_get_attachment_image_src(get_post_thumbnail_id($entry), 'full')]); ?>
  </div>
  <div class="entry__data">
    <?php get_template_part('components/atoms/title', null, ['post_title' => $entry->post_title]); ?>
    <div class="row">
      <div class="col-auto">
        <?php get_template_part('components/atoms/date', null, ['post_date' => $entry->post_date]); ?>
      </div>
      <div class="col-auto">
        <?php $tag = get_the_terms($entry->ID, ['hashtag']); ?>
        <div class="entry__tag">
          <a href="<?php echo get_tag_link($tag[0]->term_id); ?>"><?php echo $tag[0]->name; ?></a>
        </div>
      </div>
    </div>
  </div>
  <div class="entry__body">
    <?php echo do_shortcode($entry->post_content); ?>
  </div>


  <!-- TODO: 表示するものの確認から -->

</div>