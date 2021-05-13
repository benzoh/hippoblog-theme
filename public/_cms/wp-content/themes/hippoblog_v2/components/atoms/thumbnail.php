<?php
global $blog_settings;

$thumbnail = $args['post_thumbnail'][0] ? $args['post_thumbnail'][0] : $blog_settings->default_img_url;
?>

<img src="<?php echo $thumbnail ?>" alt="サムネイル画像">
