<?php
// var_dump(get_the_permalink());
?>

<div class="share-buttons">
  <ul>
    <li class="twitter">
      <a href="https://twitter.com/share" class="twitter-share-button" data-via="" data-lang="ja">ツイート</a>
      <script>
      ! function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
          p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
          js = d.createElement(s);
          js.id = id;
          js.src = p + '://platform.twitter.com/widgets.js';
          fjs.parentNode.insertBefore(js, fjs);
        }
      }(document, 'script', 'twitter-wjs');
      </script>
    </li>
    <li class="facebook">
      <div class="fb-like" data-href="<?php echo get_the_permalink(); ?>" data-width="200" data-layout="button_count"
        data-action="like" data-show-faces="true" data-share="true"></div>
      <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId: '1017626881651891',
          xfbml: true,
          version: 'v2.6'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
          return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/ja_JP/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
      </script>
    </li>
    <li class="hatena">
      <a href="http://b.hatena.ne.jp/entry/<?php echo get_the_permalink(); ?>" class="hatena-bookmark-button"
        data-hatena-bookmark-title="<?php echo get_the_title(); ?> | <?php echo bloginfo('name'); ?>"
        data-hatena-bookmark-layout="standard-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img
          src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20"
          height="20" style="border: none;" /></a>
      <script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async">
      </script>
    </li>
  </ul>
</div>