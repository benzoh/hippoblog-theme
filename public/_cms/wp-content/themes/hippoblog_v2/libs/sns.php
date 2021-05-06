<?php

// ========================================================
// Facebookにいいねの数取得
function get_like_count($page_url)
{

  // facebook
  $url = 'http://api.facebook.com/method/fql.query?query=select+total%5Fcount+from+link%5Fstat+where+url%3D%22' . $page_url . '%22';
  $xml = file_get_contents($url);
  $result = simplexml_load_string($xml);
  // var_dump($result->link_stat->total_count);

  // twitter
  // $twit_url = 'http://urls.api.twitter.com/1/urls/count.json?url=' . rawurlencode($url);
  // $json = file_get_contents($twit_url);
  // $result_twit = json_decode($json);
  // var_dump($result_twit);

  return $result->link_stat->total_count;
}