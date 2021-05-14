<?php
// _D($args);
?>

<?php if (is_single()) : ?>
<div class="">
  <a href="https://twitter.com/<?php echo $args['slug']; ?>" target="_blank">
    <img src="<?php echo CFS()->get('icon', $args['profile'][0]->ID); ?>" alt="" width="30">
    <span><?php echo $args['profile'][0]->post_title; ?></span>
  </a>
</div>
<?php endif; ?>
