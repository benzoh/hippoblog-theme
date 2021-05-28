<?php
$entry = $args ?? $post;
?>

<div class="entry">
  <div class="entry__data">
    <div class="container">
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
        <div class="col">
          <?php get_template_part('components/organisms/share_buttons'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="entry__body">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col col-md-9 px-0">
          <?php echo do_shortcode($entry->post_content); ?>
        </div>
      </div>
    </div>
  </div>


  <!-- TODO: 表示するものの確認から -->

</div>
