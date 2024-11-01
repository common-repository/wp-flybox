<?php
$twitteroptions = array('username' => get_option('wpflybox_twitter') ,'total' => get_option('wpflybox_twitter_count'), 'show_followers' => get_option('wpflybox_twitter_showfollowers'), 'border-color' => '#AAA','font-color' => '#3B5998','bordertop-color' => '#315C99','bg-color' => 'transparent', 'link_followers' => get_option('wpflybox_twitter_link'), 'width' => 220, 'tweetto' => get_option('wpflybox_twitter_tweetto'), 'latest' => get_option('wpflybox_twitter_latest'));
$lang =Array();
$lang['wpl_onTwitter']=$wpl_onTwitter;
$lang['wpl_Follow']=$wpl_Follow;
$lang['wpl_LatestTweet']=$wpl_LatestTweet;
$lang['wpl_peoplefollow']=$wpl_peoplefollow;
$lang['wpl_people']=$wpl_people;
$lang['wpl_follows']=$wpl_follows;
$lang['wpl_Tweetto']=$wpl_Tweetto;
$lang['wpl_tweetlang']=$wpl_twlang;

function wpfb_get_twitter_data($options)
  {
  $key = 'wpfb_t_' . $options['username'];
  $you = get_transient($key);
  if ($you!='' && is_string($you)){
  $you = base64_decode($you);
  $you = unserialize($you);
  }else {$you=false;}
  	if ($you !== false)
  	{
  	return $you;
  	}
require_once('TwitterAPIExchange.php');
$settings = array(
    'oauth_access_token' => "102830912-RQHOfm0Ls9zWUITBPS11LxpPmftXGuhftjU8QDuc",
    'oauth_access_token_secret' => "10mKVhjKJZN5sbbKGVkMXwFV1Je2K7TLQrwdxDUKU",
    'consumer_key' => "Ed5zIykUWHCqTuco0XcZig",
    'consumer_secret' => "8259x9CHikuJMHdXgnA1wHNxCfqMnG2TiXH46RAVZo"
); 
 //new request
$url = 'https://api.twitter.com/1.1/users/show.json';
$getfield = '?screen_name='.$options['username'];
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$response= $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();             
  //var_dump($response);      
  //$response = wp_remote_get("http://api.twitter.com/1/users/lookup.json?screen_name=$options[username]");
  if (is_wp_error($response))
		{
		return get_option($key);
    }
  $json = json_decode($response);
  if (isset($json->error) || isset($json->errors))
    {
    return get_option($key);
    }
  if(!isset($json->errors)){
  $you['name'] 			 	= $json->name;
  $you['screen_name']	 		= $json->screen_name;
  $you['followers_count'] 	= $json->followers_count;
  $you['profile_image_url']	= $json->profile_image_url_https;
  $you['friends_count']		= $json->friends_count;
  $you['description'] = $json->description;
  if ( $options['show_followers'] == 'followers' )
  			{
  			$url = 'https://api.twitter.com/1.1/followers/ids.json';
        $getfield = '?screen_name='.$options['username'].'&count=20';
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $fans = $twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
        $fans=json_decode($fans);
  				//$fans = json_decode(wp_remote_retrieve_body(wp_remote_get("http://api.twitter.com/1/followers/ids.json?screen_name=$options[username]")));
  			}
  			else
  			{
  			$url = 'https://api.twitter.com/1.1/friends/ids.json';
        $getfield = '?screen_name='.$options['username'].'&count=20';
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $fans = $twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
        $fans=json_decode($fans);  			
  			  //$fans = json_decode(wp_remote_retrieve_body(wp_remote_get("http://api.twitter.com/1/friends/ids.json?screen_name=$options[username]")));
  			}
  $twcount=count($fans->ids);
  //$you['followers']='';			
  if ($twcount > 0 )
  {			
  $fans_ids = (string)implode( ',', array_slice($fans->ids, 0, $options['total']) );
    			$url = 'https://api.twitter.com/1.1/users/lookup.json';
        $getfield = '?user_id='.$fans_ids;
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $fans = $twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
        $fans=json_decode($fans); 
  //$fans = json_decode(wp_remote_retrieve_body(wp_remote_get("http://api.twitter.com/1/users/lookup.json?user_id=$fans_ids")));
  $followers = array();
  $twmax=$options['total'];
  if  ($twcount<$twmax){$twmax=$twcount;}          
  for($i=0; $i <= $twmax; $i++)
      {
        if (is_array($fans))
          {
          if ($fans[$i] !== NULL){
            if ($fans[$i]->screen_name){
              $followers[$i]['screen_name'] = (string)$fans[$i]->screen_name;
            }
            if ($fans[$i]->profile_image_url_https){
              $followers[$i]['profile_image_url'] = (string)$fans[$i]->profile_image_url_https;
            }
            }
          }
      }
  $you['followers'] = $followers;
  }
  if ($options['latest']=='true')
    {
     			$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name='.$options['username'];
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $tweet = $twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
        $tweet=json_decode($tweet);
    //$tweet=json_decode(file_get_contents("http://api.twitter.com/1.1/statuses/user_timeline/".$options['username'].".json")); // get tweets and decode them into a variable
    if ($tweet[0])
      {
      $you['latest']=$tweet[0]->text; // show latest tweet
      }
    }
  }//end no error
  $you1=serialize($you);
  $you1=base64_encode($you1);
  set_transient($key, $you1, 60*60*4);
  update_option($key, $you1);    
  return $you;
  }
$customheight=get_option('wpflybox_twitter_customheight');
if ($customheight<1 || $customheight==='')
  {
  if ($twitteroptions['latest']=='true'){$twitteroptions['height']=125;}else{$twitteroptions['height']=60;}  
  }else{
  $twitteroptions['height']=$customheight;
  }  

function wpfb_show_custom_twitter($options, $you, $lang)
  {
  ?>
  <div style="background-color:<?php echo get_option('wpflybox_twitter_background'); ?>;border:1px solid <?php echo get_option('wpflybox_twitter_border'); ?>;display:inline-block;width:<?php echo $options['width'];?>px;padding:5px 5px 5px 5px; font-family:\'Lucida grande\',tahoma,verdana,arial,sans-serif;">
  	<div style="color:#555;border-bottom:1px solid #D8DFEA;color:#555; height:<?php echo $options['height']; ?>px; position:relative;">
  		<div style="position:absolute;top:5px;left:5px;">
  			<a target="_blank" href="http://twitter.com/<?php echo $options['username'];?>">
  				<img src="<?php echo $you['profile_image_url'];?>" width="44" height="44" alt="Twitter">
  			</a>
  		</div>
      <div style="position:absolute;top:5px;left:59px;font-size:14px;line-height:14px;font-weight:bold;">
        <a target="_blank" href="http://twitter.com/<?php echo $options['username'];?>" style="color:<?php echo $options['font-color'];?>">
        <?php echo $options['username'];?><span style="font-weight:normal;font-size:10px"> <?php echo $lang['wpl_onTwitter']; ?></span>
        </a>
      </div>
      <div style="position:absolute;top:30px;left:60px;min-width:65px;height:20px;">
        <a href="https://twitter.com/<?php echo $options['username'];?>" class="twitter-follow-button" data-show-count="false" data-width="65px" data-show-screen-name="false" data-lang="<?php echo $lang['wpl_tweetlang'];?>"><?php echo $lang['wpl_Follow']; ?> @<?php echo $options['username'];?></a>
      </div>
      <?php
      if ($options['latest']=='true'){
      ?> 
      <div style="position:absolute;top:58px;left:5px;min-width:65px;height:20px; text-align:left;font-size:12px;line-height:12px;">
       <b><?php echo $lang['wpl_LatestTweet']; ?></b>: <?php echo $you['latest']; ?>
      </div>
      <?php
      }
      ?>  
  	</div>
  	<div style="padding:0;">
  		<div style="padding:5px 5px 0px 5px;font-size:11px;">
  			<?php 
  			if ( $options['show_followers'] == 'followers')
  			{
  				echo number_format($you['followers_count']).' '.$lang['wpl_peoplefollow'].' <strong>'. $options['username'].'</strong>';
  			}
  			else
  			{
  				echo $options['username'].' '.$lang['wpl_follows'].' '. number_format($you['friends_count']).' '.$lang['wpl_people'];
  			}
  			?>	
  		</div>
  		<?php
      if ($you['followers']){ $twcount=count($you['followers']);}else{ $twcount=0;} 
      $twcount=count($you['followers']);
      $twmax= $options['total'];
      if ($twmax>$twcount){$twmax=$twcount;}
      //echo $twmax;
      for($i=0; $i < $twmax; $i++)	:?>
  			<span style="line-height:1;padding:5px 0px 3px 5px;width:48px;float:left;text-align:center;height:66px;">
  			<?php if($options['link_followers'] == 'on' ): ?>
  				<a target="_blank" href="http://twitter.com/<?php echo $you['followers'][$i]['screen_name'];?>" style="color:gray" rel="nofollow">
  			<?php endif;?>	
  					<img src="<?php echo $you['followers'][$i]['profile_image_url'];?>" width="48" height="48" alt="Twitter Pic">
  					<span style="font-family:Arial;font-size:10px;"><?php echo substr($you['followers'][$i]['screen_name'], 0, 8);?></span>
  			<?php if($options['link_followers'] == 'on' ): ?>		
  				</a>
  			<?php endif;?>		
  			</span>
  		<?php endfor;?>
  	<?php if ($options['total']>0){echo '<br style="clear:both">';} ?>
  	</div>
  <?php
  if ($options['tweetto']=='on')
    {
    echo '<div style="padding:6px 0px 6px 0px;"><a href="https://twitter.com/intent/tweet?screen_name='.$options['username'].'" class="twitter-mention-button" data-lang="'.$lang['wpl_tweetlang'].'">'.$lang['wpl_Tweetto'].' @'.$options['username'].'</a></div>'; 
    }
  ?>
  </div>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
  </script>
  <?php
  }     
$you = wpfb_get_twitter_data($twitteroptions);
if ($you)
{
wpfb_show_custom_twitter($twitteroptions, $you, $lang);
}else{
echo 'Error: Cannot reach twitter servers or incorrect username';}  
?>  