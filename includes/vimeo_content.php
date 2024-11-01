<?php
$vimeooptions = array('username' => get_option('wpflybox_vimeo_username'), 'total' => get_option('wpflybox_vimeo_total'));
$vimeolang=array('Videos'=>$wpl_Videos,'onVimeo'=>$wpl_onVimeo,'vimeoerror'=>$wpl_vimeoerror);
function wpfb_get_vimeo_data($options)
  {
  $key = 'wpfb_v_' . $options['username'];
  $you = get_transient($key);
  if ($you!='' && is_string($you)){
  $you = base64_decode($you);
  $you = unserialize($you);
  }else {$you=false;}
  	if ($you !== false)
  	{
  	return $you;
  	}      
  $response = wp_remote_get("http://vimeo.com/api/v2/$options[username]/info.json");
  if (is_wp_error($response))
		{
		return get_option($key);
    }
  $response = wp_remote_retrieve_body($response);
  if (strstr($response, 'not found'))
    {
    return get_option($key);
    }
  $json=json_decode($response);
  if ($json->error)
    {
    return get_option($key);
    }
    $you['name'] = $json->display_name;
    $you['profile_url'] = $json->profile_url;
    $you['videos_url'] = $json->videos_url;
    $you['total_videos_uploaded'] = $json->total_videos_uploaded;
    $you['portrait_medium'] = $json->portrait_medium;
    if ( $options['total'] > 0)
      {
      $videosget = wp_remote_retrieve_body(wp_remote_get("http://vimeo.com/api/v2/".$options['username']."/videos.json"));
      if (strpos($videosget, 'not found')>0)
        {
        return get_option($key);
        }
      $videojson=json_decode($videosget);  
      $videos = array();            
      for($i=0; $i <= $options['total']; $i++)
        {
        if ($videojson[$i]->id){
        $videos[$i]['id'] 		= $videojson[$i]->id;
        $videos[$i]['title'] 		= $videojson[$i]->title;
        $videos[$i]['url'] 		= $videojson[$i]->url;
        $videos[$i]['thumbnail_small'] 		= $videojson[$i]->thumbnail_small;
        } else {$i=100;}
        }
      $you['videos'] = $videos;
      }
  $you1=serialize($you);
  $you1=base64_encode($you1);
  set_transient($key, $you1, 60*60*6);
  update_option($key, $you1);    
  return $you;
  }
function wpfb_show_custom_vimeo($options, $you, $lang)
  {
  ?>
<div style="width:210px;padding:5px 5px 5px 5px; font-family:\'Lucida grande\',tahoma,verdana,arial,sans-serif;">
	<div style="color:#555;color:#555; height:55px; position:relative;padding-bottom:8px;">
		<div style="position:absolute;top:5px;left:5px;">
			<a target="_blank" href="<?php echo $you['profile_url'];?>">
				<img src="<?php echo $you['portrait_medium'];?>" width="50" height="50" alt="vimeo profile pic">
			</a>
		</div>
    <div style="position:absolute;top:5px;left:59px;font-size:14px;line-height:14px;font-weight:bold;">
      <a target="_blank" href="<?php echo $you['profile_url'];?>" style="color:#3cadc9">
      <?php echo $you['name'];?><span style="font-weight:normal;font-size:10px"> <?php echo $lang['onVimeo']; ?></span>
      </a>
    </div>
    <div style="position:absolute;top:30px;left:59px;"> 
      <?php echo $lang['Videos']; ?>: 
      <a target="_blank" href="<?php echo $you['videos_url']; ?>" style="color:#3cadc9">
      <b><?php echo number_format($you['total_videos_uploaded']); ?></b>
      </a>  
    </div> 
	</div>
<?php 			
  if ( $options['total'] > 0)
		{ ?>	
  <div style="padding:0px;border-top:1px solid #3cadc9;text-align:center;">
		<?php for($i=0; $i < $options['total']; $i++)	:?>
		  <?php if ($you['videos'][$i]['url']) { ?>
			<span class="wpfb_vimeo_vids" style="line-height:1;padding:5px 0px 5px 0px;width:48px;height:67px;display:inline-block;text-align:center;overflow:hidden;font-size:10px;">
				<a target="_blank" href="<?php echo $you['videos'][$i]['url'];?>" style="color:gray" rel="nofollow">	
					<img src="<?php echo $you['videos'][$i]['thumbnail_small'];?>" width="48" height="48" alt="vimeo video">
					<span style="font-family:Arial;font-size:10px;"><?php echo substr($you['videos'][$i]['title'], 0, 18);?></span>
				</a>		
			</span>
		<?php } else {$i=100;} ?>	
		<?php endfor;?>
	<br style="clear:both">
	</div>
<?php } ?>
</div>
  <?php
  }     
$you = wpfb_get_vimeo_data($vimeooptions);
echo '<div style="display:inline-block;background-color:'.get_option('wpflybox_vimeo_background').';border:1px solid '.get_option('wpflybox_vimeo_border').';">';
if($you)
  {
  wpfb_show_custom_vimeo($vimeooptions, $you, $vimeolang);
  } else {
  echo $wpl_vimeoerror;
  }
echo '</div>';
?>