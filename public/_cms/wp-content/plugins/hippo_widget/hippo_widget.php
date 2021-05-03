<?php
/*
Plugin Name: My Widget
Plugin URI: http://wordpress.org/extend/plugins/#
Description: This is an example plugin 
Author: Your Name
Version: 1.0
Author URI: http://example.com/
*/

class WP_Widget_HpWidget extends WP_Widget {

  function  __construct() {
    $widget_ops = array(
      'classname' => 'hp_widget',
      'description' => 'Test widget.',
    );
    parent::__construct('fuga', 'hoge', $widget_ops);
  }

  function form($instance) {
    var_dump($instance);
    if ( isset( $instance[ 'title' ] ) ) {
    $title = $instance[ 'title' ];
    }
    else {
    $title = __( 'New title', 'wpb_widget_domain' );
    }
    // Widget admin form
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <?php
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    // 
    return $instance;
  }

  function widget($args, $instance) {
    if (!is_user_logged_in()) return;

    extract($args);
    $title = apply_filters('widget_title', empty($instance['title']) ? 'hoge' : $instance['title']);
    echo $before_widget;

    if ($title) {
      echo $before_title . $title . $after_title;
    }

    echo $after_widget;
  }

}

add_action('widgets_init', function(){
  register_widget("WP_Widget_HpWidget");
});