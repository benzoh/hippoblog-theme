<?php get_template_part('components/organisms/header'); ?>

<?php
$args = array(
  'posts_per_page'   => 10,
  'orderby'          => 'date',
  'order'            => 'DESC',
  'post_type'        => ['web', 'note', 'series'],
  'post_status'      => 'publish',
  'suppress_filters' => true
);
$entries = get_posts($args);
?>

<main style="margin-top: 55px;">
  <div class="container">
    <?php if ($entries) : ?>
    <div class="d-flex flex-wrap">
      <?php get_template_part('components/molecules/entries', null, $entries); ?>
    </div>
    <?php endif; ?>
  </div>
</main>

<?php get_template_part('components/organisms/footer'); ?>
