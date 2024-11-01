<?php
$instagramoptions = array('id' => get_option('wpflybox_instagram_id') ,'token' => get_option('wpflybox_instagram_token'), 'header' => get_option('wpflybox_instagram_header'), 'max' => get_option('wpflybox_instagram_max'));
$wpfb_cached='true';
$ismedia=false;
$lang = array();
$lang['wpl_Photos']=$wpl_Photos;
$lang['wpl_Followers']=$wpl_Followers;
$lang['wpl_Following']=$wpl_Following;
$lang['wpl_invaliderror']=$wpl_invaliderror;
function wpfb_show_instagram ($options, $lang)
{
$you=Array();
$key = 'wpfb_i_' . $options['id'];
$you = get_transient($key);
if ($you!='' && is_string($you)){
$you = base64_decode($you);
$you = unserialize($you);
}else {$you=false;}
echo '<div style="width:224px;text-align: center;overflow:hidden;">';
if ($options['header']=='true')
{
  if (!$you['username'])
  	{
  	$wpfb_cached='false';
    $wpflybox_instagram_jsonfile = wp_remote_get('https://api.instagram.com/v1/users/'.$options['id'].'/?access_token='.$options['token']);
    if (is_wp_error($wpflybox_instagram_jsonfile))
		  {
		  $you = get_option($key);
      } else {
      $json = json_decode(wp_remote_retrieve_body($wpflybox_instagram_jsonfile));
      $you['profile_picture'] = $json->data->profile_picture;
      $you['username'] = $json->data->username;
      $you['mediacount'] = $json->data->counts->media;
      $you['followedby'] = $json->data->counts->followed_by;
      $you['follows'] = $json->data->counts->follows;
      }
    } else {
    //$wpfb_cached=='true';
    }
  if ($you['username']){  
  echo '<table style="padding:2px;border:none;margin:0px;" class="wpflyboxtable">';
  echo '<tr style="padding:3px;"><td><img src="'.$you['profile_picture'].'" height="40" width="40" title="'.$you['username'].'" alt="'.$you['username'].'"></td>';
  echo '<td style="text-align:center"><div style="font-weight:bold;font-size:16px;margin-top:4px;">'.$you['mediacount'].'</div><div style="font-size:10px;">&nbsp;'.$lang['wpl_Photos'].'</div></td>';
  echo '<td style="text-align:center"><div style="font-weight:bold;font-size:16px;margin-top:4px;">'.$you['followedby'].'</div><div style="font-size:10px;">&nbsp;'.$lang['wpl_Followers'].'</div></td>';
  echo '<td style="text-align:center"><div style="font-weight:bold;font-size:16px;margin-top:4px;">'.$you['follows'].'</div><div style="font-size:10px;">&nbsp;'.$lang['wpl_Following'].'</div></td></tr>';
  echo '</table>';
  } else {echo $lang['wpl_invaliderror'];}
}
if (!$you['media'] || $wpfb_cached=='false')
  {
  $wpfb_cached='false';
  $wpflybox_instagram_jsonfile = wp_remote_get('https://api.instagram.com/v1/users/'.$options['id'].'/media/recent/?access_token='.$options['token']);
  //echo 'https://api.instagram.com/v1/users/'.$options[id].'/media/recent/?access_token='.$options[token];
  if (is_wp_error($wpflybox_instagram_jsonfile))
		  {
		  echo $lang['wpl_invaliderror'];
		  return false;
		  } else {
		  $json = json_decode(wp_remote_retrieve_body($wpflybox_instagram_jsonfile));
      $media=array();
      $ismedia=false;
      for($m=1; $m <= $options['max']; $m++)
        {
        if ($json->data)
          {
          $media[$m]['link'] = (string)$json->data[$m-1]->link;
          $media[$m]['thumburl'] = (string)$json->data[$m-1]->images->thumbnail->url;
          $media[$m]['text'] = (string)$json->data[$m-1]->caption->text;
          $ismedia=true;
         
          } 
        }    
      $you['media']=$media;  
      }
  } else {
  $media = $you['media'];
  }
  if ($media){
  for($m=1; $m <= $options['max']; $m++)
  {
    if ($media[$m]['thumburl'])
    {
    echo '<a href="'.$media[$m]['link'].'" target="_blank"><img src="'.$media[$m]['thumburl'].'" height="50" width="50" style="padding:3px;" alt="'.$media[$m]['text'].'" title="'.$media[$m]['text'].'"></a>';
    }
  }
  } else {echo '<br>'.$lang['wpl_invaliderror'];}
echo '</div>';
if ($wpfb_cached=='false')
  {
  $you=serialize($you);
  $you=base64_encode($you);
  set_transient($key, $you, 60*60*3);
  update_option($key, $you);
  }
} //end function
echo '<div style="background-color:'.get_option('wpflybox_instagram_background').';display:inline-block;border:1px solid '.get_option('wpflybox_instagram_border').';">';
wpfb_show_instagram($instagramoptions,$lang);
echo '</div>';
?>