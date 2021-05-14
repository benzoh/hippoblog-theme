<?php if (is_home()) : ?>
<h2 class="title"><?php echo $args['post_title']; ?></h2>
<?php else : ?>
<h1 class="title"><?php echo $args['post_title']; ?></h1>
<?php endif; ?>
