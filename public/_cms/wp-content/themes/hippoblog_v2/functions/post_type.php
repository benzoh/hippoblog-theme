<?php

// ========================================================
// カスタム投稿を追加

$params = array(
  'labels' => array(
    'name' => 'Web開発',
  ),
  'public' => true,
  'has_archive' => true,
  'hierarchical' => true,
  'menu_position' => 5,
  'exclude_from_search' => false,
  'supports' => array(
    'title',
    'editor',
    'author',
    'thumbnail',
  ),
);
register_post_type('web', $params);

$params = array(
  'labels' => array(
    'name' => '雑記',
  ),
  'public' => true,
  'has_archive' => true,
  'hierarchical' => true,
  'menu_position' => 5,
  'supports' => array(
    'title',
    'editor',
    'author',
    'thumbnail',
  ),
);
register_post_type('note', $params);

$params = array(
  'labels' => array(
    'name' => 'シリーズ',
  ),
  'public' => true,
  'has_archive' => true,
  'hierarchical' => true,
  'menu_position' => 5,
  'supports' => array(
    'title',
    'editor',
    'author',
    'thumbnail',
  ),
);
register_post_type('series', $params);

$params = array(
  'labels' => array(
    'name' => '投稿者情報',
  ),
  'public' => true,
);
register_post_type('profile', $params);

// ========================================================
// タクソノミー設定

register_taxonomy(
  'hashtag',
  ['web', 'note', 'series'],
  array(
    'label' => 'HashTag',
    'hierarchical' => true,
    'query_var' => true,
    'rewrite' => true,
  )
);

// ========================================================
// 表示件数を動的に変更

function change_posts_per_page($query)
{
  if (is_admin() || !$query->is_main_query()) {
    return;
  }
  if ($query->is_archive() || $query->is_search()) {
    $query->set('posts_per_page', '18');
  }
}
add_action('pre_get_posts', 'change_posts_per_page');


/**
 * サイト内検索にカスタム投稿を含める
 */
function search_filter($query)
{
  if (!is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('web', 'note'));
    }
  }
}
add_action('pre_get_posts', 'search_filter');


// RSSフィードにカスタム投稿タイプも含める
function add_custom_post_feed($query)
{
  // 	フィードリクエストの場合に実行
  if (is_feed()) {
    // post_type（投稿タイプ）が空なら全体の RSS
    $post_type = $query->get('post_type');
    if (empty($post_type)) {
      // 			通常の投稿とカスタム投稿タイプを指定
      $query->set('post_type', array('web', 'note',));
    }
    return $query;
  }
}
// pre_get_posts フィルターに追加
add_filter('pre_get_posts', 'add_custom_post_feed');