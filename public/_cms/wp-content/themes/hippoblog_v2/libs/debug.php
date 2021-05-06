<?php
// デバッグ
function _D($hoge = null, $fuga = null, $piyo = null)
{
  if (DEBUG_MODE === true) {
    echo '<pre>';
    echo 'FILE:' . __FILE__ . '<br>LINE:' . __LINE__ . '<br>';
    var_dump($hoge, $fuga, $piyo);
    echo '</pre>';
  } else {
    return;
  }
}