<?php
$hp = new HippoPlugin();
if ($_POST['posted'] == true) $hp->_hp_update_options($_POST);
$settings = $hp->_hp_get_options();
?>

<div class="wrap">
  <h2>Your Plugin Name</h2>

  <?php if ($_POST['posted'] == true): ?>
    <div class="updated"><p><strong>Settings updated.</strong></p></div>
  <?php endif; ?>

  <form method="post" action="">
    <?php settings_fields( 'hippo-plugin-settings' ); ?>
    <?php do_settings_sections( 'hippo-plugin-settings' ); ?>

    <input type="hidden" name="posted" value="true">

    <table class="form-table">
      <tr valign="top">
        <th scope="row">_hp_hoge</th>
        <td>
          <input
            type="text"
            name="_hp_hoge"
            value="<?php echo esc_attr( $settings->_hp_hoge ); ?>"
            class="regular-text code"
          >
          <div><small>色は匂へど散りぬるを、我が世たれぞ常ならむ。有為の奥山今日越えて、浅き夢見じ、酔ひもせず。</small></div>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">_hp_int</th>
        <td>
          <input
            type="text"
            name="_hp_int"
            value="<?php echo esc_attr( $settings->_hp_int ); ?>"
            class="short-text code"
          >
          <div><small>数値入力</small></div>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">_hp_fuga</th>
        <td>
          <?php $fuga_options = $settings->_hp_fuga; ?>
          <?php $options = ['hoge', 'fuga', 'piyo']; ?>
          <?php foreach($options as $option): ?>
            <input
              type="checkbox"
              name="_hp_fuga[<?php echo $option; ?>]"
              value="true"
              class=""
              id="fuga_<?php echo esc_attr($option); ?>"
              <?php echo($fuga_options[$option] == true ? 'checked' : ''); ?>
            >
            <label for="fuga_<?php echo esc_attr($option); ?>" style="margin-right:1em;">
              <?php echo esc_attr($option); ?>
            </label>
          <?php endforeach; ?>
          <div><small>配列から出力</small></div>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">Themes</th>
        <td style="display:flex;">
          <?php $set_theme = $settings->_hp_theme; ?>
          <?php foreach($hp->themes as $theme): ?>
            <div style="margin-right:20px;">
              <div>
                <img src="<?php echo $hp->theme_thumbnail_urls[$theme]; ?>" width="200px" alt="">
              </div>
              <input
                type="radio"
                name="_hp_theme"
                value="<?php echo $theme; ?>"
                class=""
                id="theme_<?php echo esc_attr($theme); ?>"
                <?php echo($set_theme == $theme ? 'checked' : ''); ?>
              >
              <label for="theme_<?php echo esc_attr($theme); ?>" style="margin-right:1em;">
                <?php echo esc_attr($theme); ?>
              </label>
            </div>
          <?php endforeach; ?>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">Footer</th>
        <td>
          <input
            type="text"
            name="_hp_module_footer"
            value="<?php echo esc_attr( $settings->_hp_module_footer ); ?>"
            class="short-text code"
          >
          <div><small>数値入力</small></div>
        </td>
      </tr>
    </table>

    <?php submit_button(); ?>

  </form>
</div>