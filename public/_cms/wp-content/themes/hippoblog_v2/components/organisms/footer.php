<?php
echo __FILE__;
?>

<footer>
  <div class="container">
    <h3>Tag List</h3>
    <ul class="d-flex flex-wrap">
      <?php
      $terms = get_terms(['hashtag']);
      foreach ($terms as $term) {
        echo '<li><a href="' . get_tag_link($term->term_id) . '">' . $term->name . '</a></li>';
      }
      ?>
      <?php
      $tags = get_tags();
      foreach ($tags as $tag) {
        echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
      }
      ?>
    </ul>
    <p class="copy">© <?php echo date("Y"); ?> <?php bloginfo('name'); ?></p>
  </div>
</footer>
