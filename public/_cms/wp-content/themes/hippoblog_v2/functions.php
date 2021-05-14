<?php

add_editor_style("editor-style.css");
add_theme_support('html5', array('search-form'));
add_theme_support('post-thumbnails');

include_once dirname(__FILE__) . '/functions/assets_enqueue.php';
include_once dirname(__FILE__) . '/functions/post_type.php';

include_once dirname(__FILE__) . '/libs/debug.php';
include_once dirname(__FILE__) . '/libs/sns.php';

$blog_settings = new stdClass;
$blog_settings->default_img_url = home_url() . '/_cms/wp-content/uploads/2016/05/no_image02.png';
$blog_settings->current_page = '';

// wp_link_pages()のラッパー関数
function org_link_pages()
{
  $defaults = array(
    'before'           => __(''),
    'after'            => '',
    'link_before'      => '<span class="link">',
    'link_after'       => '</span>',
    'next_or_number'   => 'number',
    'separator'        => '@',
    // 'nextpagelink'     => '<div>' . __( '<span>次のページ</span>' ) . '</div>', // なんか出力しないのでコメントアウト
    // 'previouspagelink' => __( '<span>前のページ</span>' ), // なんか出力しないのでコメントアウト
    'pagelink'         => '%',
    'echo'             => 0
  );
  $html = wp_link_pages($defaults);
  // var_dump($html);
  // 分解
  $str_split = explode('@', $html);
  // var_dump($str_split);
  $search_result = [];

  // リンクの無いページを検索
  foreach ($str_split as $str) {
    $search_result[] .= strpos($str, 'href');
  }

  $non_link = array_search('', $search_result);
  // $blog_settings->current_page .= $non_link; // TODO
  // var_dump($non_link);

  // 前のページのhtml生成
  // var_dump($str_split[$non_link - 1]);
  preg_match('/<a.+href="[!-~]+">/', $str_split[$non_link - 1], $href_args);
  preg_match('/"[!-~]+"/', $href_args[0], $href);
  $prev_link = $href[0];

  // 次のページのhtml生成
  preg_match('/<a.+href="[!-~]+">/', $str_split[$non_link + 1], $href_args);
  preg_match('/"[!-~]+"/', $href_args[0], $href);
  $next_link = $href[0];

  // 最初の配列にリンクあるとき
  if (strpos($str_split[0], '<a href') !== false) { // ここは正規表現でやった方が良い
    // var_dump('has');
    $str_split[0] = '<a class="prev" href=' . $prev_link . '>前のページへ</a>' . $str_split[0];
  }
  // var_dump($str_split);

  // 最後の配列にリンクあるとき
  $last_array = end($str_split);
  if (strpos($last_array, '<a href') !== false) { // ここは正規表現でやった方が良い
    // var_dump('has');
    $str_split[] = '<a class="next" href=' . $next_link . '>次のページへ</a>';
  }
  // var_dump($str_split);

  $codes = $str_split;
  return $codes;
}

// ========================================================
// 複数ページ記事のタイトル重複対策

// view : if($pages !== '(1/1)'){ echo $pages; }

function title_rebuild()
{
  global $post;
  global $blog_settings;

  $cont = get_post($post->ID);
  // var_dump($cont->post_content);

  preg_match_all('/<!--nextpage-->/', $cont->post_content, $matches);
  // var_dump($matches);

  $pages = count($matches[0]) + 1; // 最後のページ数
  // var_dump($pages);

  // カレントページ
  $current = $blog_settings->current_page; // TODO

  $add_title_html = ' (' . $current . '/' . $pages . ')';

  return $add_title_html;
}

// ========================================================
// ads読み込み用ショートコード [ads_html]
function shortcode_ads_w300()
{
  $ads_html = '<div class="m-ads_w300">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- スマホ用（ロングとの入れ替え用）2 -->
        <ins class="adsbygoogle"
                style="display:inline-block;width:300px;height:250px"
                data-ad-client="ca-pub-7815961604338808"
                data-ad-slot="7582629372"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    ';
  return $ads_html;
}
add_shortcode('ads_html', 'shortcode_ads_w300');

/**
 * Disable Emoji
 *
 * @return void
 */
function disable_emoji()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'disable_emoji');

/**
 * 管理画面カスタム投稿一覧にタクソノミー表示
 *
 * @param [type] $columns
 * @return void
 */
function manage_web_post_th($columns)
{
  echo "<style>#title {width: 50%;}</style>"; // これ悪手
  unset($columns['date']); // 順番入れ替えのため一旦unset
  $columns['hashtag'] = "HashTag";
  $columns['date'] = "日付";
  return $columns;
}
add_filter('manage_edit-web_columns', 'manage_web_post_th');

function manage_note_post_th($columns)
{
  echo "<style>#title {width: 50%;}</style>"; // これ悪手
  unset($columns['date']); // 順番入れ替えのため一旦unset
  $columns['hashtag'] = "HashTag";
  $columns['date'] = "日付";
  return $columns;
}
add_filter('manage_edit-note_columns', 'manage_note_post_th');

function manage_series_post_th($columns)
{
  echo "<style>#title {width: 50%;}</style>"; // これ悪手
  unset($columns['date']); // 順番入れ替えのため一旦unset
  $columns['hashtag'] = "HashTag";
  $columns['date'] = "日付";
  return $columns;
}
add_filter('manage_edit-series_columns', 'manage_series_post_th');

function manage_web_post_td($column_name, $post_id)
{
  if ($column_name == 'hashtag') {
    $terms = get_the_terms($post_id, 'hashtag');
    if ($terms) {
      $category = array_shift($terms);
      echo $category->name;
    }
  }
}
add_action('manage_web_posts_custom_column', 'manage_web_post_td', 10, 2);

function manage_note_post_td($column_name, $post_id)
{
  if ($column_name == 'hashtag') {
    $terms = get_the_terms($post_id, 'hashtag');
    if ($terms) {
      $category = array_shift($terms);
      echo $category->name;
    }
  }
}
add_action('manage_note_posts_custom_column', 'manage_note_post_td', 10, 2);

function manage_series_post_td($column_name, $post_id)
{
  if ($column_name == 'hashtag') {
    $terms = get_the_terms($post_id, 'hashtag');
    if ($terms) {
      $category = array_shift($terms);
      echo $category->name;
    }
  }
}
add_action('manage_series_posts_custom_column', 'manage_series_post_td', 10, 2);

function _get_page_component($component_name)
{
  get_template_part('components/pages/' . $component_name);
}

// 自動的にリダイレクトするの拒否
add_filter('redirect_canonical', '_no_redirect_on_404');
function _no_redirect_on_404($redirect_url)
{
  if (is_404()) {
    return false;
  }
  return $redirect_url;
}