<?php
echo __FILE__;
// exit;
?>

<!doctype html>
<html lang="ja">

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <?php // get_template_part( 'modules/header/gtag' );
  ?>
  <?php // get_template_part( 'modules/body/auto_ads' );
  ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keyword" content="@hippohack, hippoblog">
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Cache-Control" content="max-age=31557600">
  <link rel="preconnect" href="https://www.googletagservices.com">
  <link rel="preconnect" href="https://googleads.g.doubleclick.net">
  <link rel="preconnect" href="https://www.google-analytics.com">
  <link rel="preconnect" href="https://adservice.google.co.jp">
  <?php // get_template_part( 'modules/header/schema' );
  ?>
  <?php // get_template_part( 'modules/header/favicon' );
  ?>
  <?php
  if (is_single()) {
    $current_page_num = '';
    $pages = count(explode('<!--nextpage-->', $post->post_content));
    if ($page !== '0') {
      $current_page_num = '（' . $page . '/' . $pages . '）';
    }
  }
  ?>
  <title>
    <?php wp_title('|', true, 'right');
    bloginfo('name');
    if ($page !== 0) {
      echo $current_page_num;
    } ?>
  </title>
  <?php wp_head(); ?>
</head>

<body>
  <?php _get_page_component($args['component_name']); ?>

  <?php wp_footer(); ?>
</body>

</html>

<?php
global $wp_query;
_D($wp_query);

?>
<?php _D(get_option('rewrite_rules')); ?>
