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

<?php if ($entries) : ?>
<div class="d-flex flex-wrap">
  <?php get_template_part('components/molecules/entries', null, $entries); ?>
</div>
<?php endif; ?>

<?php get_template_part('components/organisms/footer'); ?>
