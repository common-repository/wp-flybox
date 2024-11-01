<?php
$tulogoleft=ceil(get_option('wpflybox_tumblr_width')-96)/2;
$you=Array();
$key = 'wpfb_tu_' . str_replace('.','',get_option('wpflybox_tumblr'));
$you = get_transient($key);
if ($you!='' && is_string($you)){
$you = base64_decode($you);
$you = unserialize($you);
}else {$you=false;}
echo '<div style="overflow:hidden;background:'.get_option('wpflybox_tumblr_background').';border:1px solid '.get_option('wpflybox_tumblr_border').';display:inline-block;position:relative;height:'.get_option('wpflybox_tumblr_height').'px;width:'.get_option('wpflybox_tumblr_width').'px;">';
echo '<img src="http://api.tumblr.com/v2/blog/'.get_option('wpflybox_tumblr').'/avatar/96" style="width:96px;height:96px;display:inline-block;position:absolute;top:3px;left:'.$tulogoleft.'px;" />';
$request=wp_remote_get('http://api.tumblr.com/v2/blog/'.get_option('wpflybox_tumblr').'/info?api_key=5xmt28D72uj1Q1kpQwqs8DnBM6UzBhVzeerYo6iai2TZyuI1QR');
if (!is_wp_error($request) && (!$you['title'] || !$you['url'] || !$you['posts']))
  {
  $json = json_decode(wp_remote_retrieve_body($request));
  if ($json->meta->status=='200')
    {
    $you['title'] = $json->response->blog->title;
    $you['url'] = $json->response->blog->url;
    $you['posts'] = $json->response->blog->posts; 
    }
  }
echo '<div style="position:absolute;top:105px;font-size:14px;text-align:center;margin:0px auto;width:100%;"><a href="'.$you['url'].'" target="_blank" >'.$you['title'].'</a>';
echo '<br />'.$you['posts'].' posts<br /><br ><u>Recent Posts:</u><br />';

$request=wp_remote_get('http://api.tumblr.com/v2/blog/'.get_option('wpflybox_tumblr').'/posts/photo?api_key=5xmt28D72uj1Q1kpQwqs8DnBM6UzBhVzeerYo6iai2TZyuI1QR');
if (!is_wp_error($request) && !$you['photo_posts'])
  {
  $json = json_decode(wp_remote_retrieve_body($request));
  if ($json->meta->status=='200')
    {
    $you['photo_posts']=$json->response->posts;
    }
  }
  $tui=0;
  $tumax=get_option('wpflybox_tumblr_max'); 
  foreach ($you['photo_posts'] as $value)
    {
      if ($tui<$tumax)
        {
        echo '<a href="'.$value->post_url.'" target="_blank" >';
        foreach ($value->photos[0]->alt_sizes as $value2)
          {
          if ($value2->width=='75')
            {
            echo '<img src="'.$value2->url.'" style="padding:2px;" /></a>';
            }
          }
      }
    $tui=$tui+1;   
    }
  
$you1=serialize($you);
$you1=base64_encode($you1);
set_transient($key, $you1, 60*60*12);
update_option($key, $you1);  

echo '</div></div>';
?>