<?php
/*
Plugin Name: Hippo Plugin
Plugin URI: null
Description: null
Version: 1.0.0
Author: @hippohack
Author URI: https://www.hippohack.me
License: GPL2
*/

// test
// include dirname(__FILE__) . '/hp_widget/hp_widget.php';

class HippoPlugin
{

  public $themes = ['blue', 'red', 'green'];
  public $theme_thumbnail_urls = [
    'blue' => 'https://placehold.jp/300x240.png',
    'red' => 'https://placehold.jp/300x240.png',
    'green' => 'https://placehold.jp/300x240.png',
  ];

  static function init() {
    return new self();
  }

  function __construct() {
    if (is_admin() && is_user_logged_in()) {
      add_action('admin_menu', [$this, '_hp_add_submenu']);
      add_action('admin_init', [$this, '_hp_register_mysettings']);
    }
  }

  function _hp_add_submenu() {
    add_submenu_page('options-general.php', 'HippoPlugin Setting', 'HippoPlugin Setting', 8, __FILE__, [$this, '_hp_admin_page']);
  }

  // これいらん気がするけども。。。
  function _hp_register_mysettings() {
    register_setting( 'hippo-plugin-settings', 'one' );
    register_setting( 'hippo-plugin-settings', 'two' );
    register_setting( 'hippo-plugin-settings', 'three' );
  }

  function _hp_admin_page() {
    require dirname(__FILE__) . '/hippo-plugin-admin.php';
  }

  // like検索とかで取ってきてもいいような
  function _hp_get_options() {
    $obj = new stdClass;
    $obj->_hp_hoge = get_option('_hp_hoge');
    $obj->_hp_fuga = get_option('_hp_fuga');
    $obj->_hp_piyo = get_option('_hp_piyo');
    $obj->_hp_int = get_option('_hp_int');
    $obj->_hp_installed = get_option('_hp_installed');
    $obj->_hp_theme = get_option('_hp_theme');
    $obj->_hp_module_footer = get_option('_hp_module_footer');
    return $obj;
  }

  function _hp_update_options($params) {
    var_dump($params);
    // exit;
    update_option('_hp_hoge', stripslashes($params['_hp_hoge']));
    update_option('_hp_int', intval($params['_hp_int']));
    update_option('_hp_fuga', $params['_hp_fuga']);
    update_option('_hp_theme', $params['_hp_theme']);
    update_option('_hp_module_footer', $params['_hp_module_footer']);
  }

  function _hp_plugin_activate() {
    if (!get_option('_hp_installed')) {
      // initialize
      $foo = new stdClass;
      $foo->hoge = 'hoge';
      update_option('_hp_hoge', 'hoge');
      update_option('_hp_fuga', ['hoge' => true, 'fuga' => false, 'piyo' => true]);
      update_option('_hp_piyo', $foo);
      update_option('_hp_int', 123);
      update_option('_hp_module_footer', 1);

      // インストール済みの判定用
      update_option('_hp_installed', true);
    }
  }

  /**
   * Get plugin's module
   *
   * @param string $module_name
   * @param array $options = ['only' => ['is_home', 'is_single', 'is_page', 'is_archive', 'is_404']]
   * @return void
   */
  function _hp_get_module(String $module_name, $options = []) {
    $setting = get_option("_hp_module_{$module_name}");
    if ($setting && empty($options)) {
      include_once dirname(__FILE__) . '/modules/' . $module_name . '.php';
    } elseif ($setting && $options['only']) {
      // is_home
      if (call_user_func($options['only'])) {
        include_once dirname(__FILE__) . '/modules/' . $module_name . '.php';
      }
    }
  }

  function hippo_install() {
    global $wpdb;
    $table_name = $wpdb->prefix . "hippo_values";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      name tinytext NOT NULL,
      text text NOT NULL,
      url varchar(55) DEFAULT '' NOT NULL,
      UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
  }

  function add_init_data() {
    global $wpdb;
    $name = 'hippo';
    $text = 'cool!!';

    $table_name = $wpdb->prefix . "hippo_values";

    $wpdb->insert(
      $table_name,
      array(
        'time' => current_time( 'mysql' ),
        'name' => $name,
        'text' => $text,
      )
    );
  }

  function get_data() {
    $wpdb = new hippp_wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

    $id = 1;
    $data = $wpdb->get_results(
      $wpdb->prepare(
        "SELECT * FROM `wphhackblog_hippo_values` WHERE id = %s",
        "SELECT * FROM $wpdb->hippo_values WHERE id = %s",
        $id
      )
    );

    return $data;
  }

  function update_data() {
    $wpdb = new hippp_wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

    $id = 1;
    $new_value = 'hoge';
    $updated = $wpdb->update( 'wphhackblog_hippo_values', ['text' => $new_value], ['id' => $id] );
    return $updated;
  }
}

// これおんなじことやってる気がするが。
add_action('init', 'HippoPlugin::init');
// $hippo_plugin = new HippoPlugin();

register_activation_hook( __FILE__, ['HippoPlugin', '_hp_plugin_activate'] );
register_activation_hook( __FILE__, ['HippoPlugin', 'hippo_install'] );
register_activation_hook( __FILE__, ['HippoPlugin', 'add_init_data'] );


require_once( ABSPATH . WPINC . '/wp-db.php' );
class hippp_wpdb extends wpdb {
  // カスタマイズしたい wpdb のメソッドをオーバーライドする
  var $tables = array(
		'posts',
		'comments',
		'links',
		'options',
		'postmeta',
		'terms',
		'term_taxonomy',
		'term_relationships',
		'termmeta',
    'commentmeta',
    'hippo_values'
	);
}

