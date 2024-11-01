<?php
if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
include ('wpfb_options_functions.php');   
echo '<script type="text/javascript" src="'.plugins_url().'/wp-flybox/static/jscolor/jscolor.js"></script>';
include ('defaults.php');
wpfb_set_defaults($wpfb_defaults);
include ('lang/'.get_option('wpflybox_language').'-admin.php');
if (!strstr(get_option('wpflybox_facebook'), 'facebook.com/')){$wpflybox_facebook="http://facebook.com/".get_option('wpflybox_facebook');update_option('wpflybox_facebook', $wpflybox_facebook);}
wpfb_update_options($wpl_Optionssaved,$wpl_Cachesdeleted);                                                                                        
$wpfb_active_tab=wpfb_show_header();
if ($wpfb_active_tab=='general')
  {
  ?>
  <div class="postbox-container">
    <div class="metabox-holder">
      <div class="meta-box">
        <div class="postbox" style="width:100%;">
          <div class="inside">
            <form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
              <table cellpadding="3">
                <?php
                //Which Side
                $wpfb_choices=array($wpl_NoneOff => 'none', $wpl_Left => 'left', $wpl_Right=> 'right');
                wpfb_form_option('wpflybox_side',$wpl_Whichside,$wpl_WhichsideDesc,$wpfb_choices);
                //Hover or Click
                $wpfb_choices=array($wpl_Hover => 'hover', $wpl_Click => 'click');
                wpfb_form_option('wpflybox_hoverorclick',$wpl_HoverOrClick,'',$wpfb_choices);                
                //Number of Tabs
                $wpfb_choices=array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8');
                wpfb_form_option('wpflybox_count',$wpl_Howmanytabs,'<input type="submit" name="Submit" value="Apply" />',$wpfb_choices);
                //Tabs
                $wpfb_i=1;
                $wpfb_max=get_option('wpflybox_count');
                while ($wpfb_i<=$wpfb_max)
                  {                  
                  $wpfb_choices=array('Facebook' => 'facebook', 'Twitter' => 'twitter', 'Google Plus' => 'googleplus', 'Youtube' => 'youtube', 'Feedburner Subscription' => 'subscription', 'Pinterest' => 'pinterest', 'Linked In' => 'linkedin', 'Flickr' => 'flickr', 'Contact Me/Us' => 'contact', 'Deviant Art' => 'deviant', 'Instagram' => 'instagram', 'Vimeo' => 'vimeo', 'Tumblr' => 'tumblr', 'Custom #1' => 'custom', 'Custom #2' => 'custom2', 'Custom #3' => 'custom3', 'Custom #4' => 'custom4');
                  wpfb_form_option('wpflybox_tab'.$wpfb_i,$wpl_Tab.' #'.$wpfb_i,'',$wpfb_choices);
                  $wpfb_i++;
                  }
                echo '<tr><td colspan="2">'.$wpl_Notesamething.'</td></tr>';
                //Language
                $wpfb_choices=array($wpl_English => 'en-US', $wpl_Spanish => 'es', $wpl_Polish => 'pl');
                wpfb_form_option('wpflybox_language',$wpl_Language,$wpl_LangDesc,$wpfb_choices); 
                ?>
                <tr>
                  <td>
                    <p class="submit">
  				            <input class="button-primary" type="submit" name="Submit" value="<?php echo $wpl_UpdateOptions; ?>" />
  				          </p>
                  </td>
                </tr>                                  
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php		
	}	
if ($wpfb_active_tab=='display')
  {
  ?>
  <div class="postbox-container">
    <div class="metabox-holder">
      <div class="meta-box">
        <div class="postbox" style="width:100%;">
          <div class="inside">
            <form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
              <table cellpadding="3">
                <?php                
                //Starting Height
                wpfb_form_input('wpflybox_start','4',$wpl_Howhigh,'px (ex: 20)');
                //Separation
                wpfb_form_input('wpflybox_seperation','4',$wpl_Amountofsep,'px (ex: 103)');
                //Float Tabs
                $wpfb_choices=array($wpl_FloatWithWindow => 'fixed', $wpl_AttachedToPage => 'absolute');
                wpfb_form_option('wpflybox_position',$wpl_FloatTabs,$wpl_FloatDesc,$wpfb_choices);
                
                 $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                wpfb_form_option('wpflybox_remove_filler',$wpl_RemoveFiller,$wpl_RemoveFillerDesc,$wpfb_choices);
                
                //Hide/Show on Pages
                echo '<tr><td>&nbsp;</td></tr>';
                echo '<tr><td style="text-align:right;">'.$wpl_ShowOptions.':</td><td>';
                wpfb_form_checkbox('wpflybox_showon_front','',$wpl_MainPage.',&nbsp;&nbsp;&nbsp;');
                wpfb_form_checkbox('wpflybox_showon_page','',$wpl_Pages.',&nbsp;&nbsp;&nbsp;');
                wpfb_form_checkbox('wpflybox_showon_post','',$wpl_Posts.',&nbsp;&nbsp;&nbsp;');
                wpfb_form_checkbox('wpflybox_showon_archive','',$wpl_Archives.',&nbsp;&nbsp;&nbsp;');
                wpfb_form_checkbox('wpflybox_showon_feed','',$wpl_Feeds.',&nbsp;&nbsp;&nbsp;');
                wpfb_form_checkbox('wpflybox_showon_search','',$wpl_Search.',&nbsp;&nbsp;&nbsp;');
                wpfb_form_checkbox('wpflybox_showon_guest','',$wpl_ForGuests.',&nbsp;&nbsp;&nbsp;');
                wpfb_form_checkbox('wpflybox_showon_logged','',$wpl_ForUsers.',&nbsp;&nbsp;&nbsp;');
                wpfb_form_input('wpflybox_showon_pid','60','<br />'.$wpl_ShowOnwith,$wpl_IDsSep);
                wpfb_form_input('wpflybox_showon_pidhide','60','<br />'.$wpl_HideOnwith,$wpl_IDsSep);
                wpfb_form_input('wpflybox_showon_urlhide','60','Hide on pages<br />containing URL','Separate values with commas. Do NOT use quotes.');
                echo '<tr><td></td><td>';
                echo '<a href="http://en.forums.wordpress.com/topic/any-one-know-how-to-find-page-ids" target="_blank" title="Help Finding IDs">'.$wpl_HelpFindingID.'</a> For the plugin to be visible, both a page option and a user option must be set.';
                echo '</td></tr>';
                echo '<tr><td>&nbsp;</td></tr>';
                //Custom Button
                include('wpfb_options_custombutton.php'); 
                ?>
                <tr>
                  <td></td>
                  <td>
                  <?php echo $wpl_customTabIndividual; ?>You can use custom buttons (URL of image) for each individual tab in the "Edit Tabs" options.
                  </td></tr>
                <?php
                $wpfb_i=1;
                $wpfb_max=get_option('wpflybox_count');
                while ($wpfb_i<=$wpfb_max)
                  {                  
                  wpfb_form_input('wpflybox_tab'.$wpfb_i.'_auto_out','5',$wpl_Autoshow.' #'.$wpfb_i,$wpl_AutoshowDesc);
                  echo '<tr><td></td><td>';
                  wpfb_form_checkbox('wpflybox_tab'.$wpfb_i.'_auto_out_onlyhome','<b>'.$wpl_AutoshowOnlyHome.' (Tab #'.$wpfb_i.'):&nbsp;&nbsp;</b>','( '.$wpl_AutoshowOnlyHomeDesc.' )');
                  echo '</td></tr>';
                  echo '<tr><td></td><td>';
                  wpfb_form_checkbox('wpflybox_tab'.$wpfb_i.'_auto_out_cookie','<b>'.$wpl_AutoshowOnlyNew.' (Tab #'.$wpfb_i.'):&nbsp;&nbsp;</b>','( '.$wpl_AutoshowOnlyNewDesc.' )');
                  echo '</td></tr>';
                  $wpfb_i++;
                  }
                  ?>
                  <tr><td>
                    <p class="submit">
  				            <input class="button-primary" type="submit" name="Submit" value="<?php echo $wpl_UpdateOptions; ?>" />
  				          </p>
                  </td>
                </tr>                                 
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php		
	}	
if ($wpfb_active_tab=='tabs')
  {
  ?>
  <div class="postbox-container">
    <form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
      <div class="metabox-holder">
        <?php
        $wpfb_i=1;
        $wpfb_max=get_option('wpflybox_count');
        while ($wpfb_i<=$wpfb_max){
          ?>
            <div class="meta-box">
              <div class="postbox" style="width:100%;">
                <h3 class="hndle">
                  <?php
                  $tab=get_option('wpflybox_tab'.$wpfb_i);
                  if ($tab=='facebook'){echo 'Facebook';} else
                  if ($tab=='twitter'){echo 'Twitter';} else
                  if ($tab=='googleplus'){echo 'Google Plus';} else
                  if ($tab=='youtube'){echo 'Youtube';} else
                  if ($tab=='subscription'){echo 'Feedburner Subscription';} else
                  if ($tab=='pinterest'){echo 'Pinterest';} else
                  if ($tab=='linkedin'){echo 'Linked In';} else
                  if ($tab=='flickr'){echo 'Flickr';} else
                  if ($tab=='contact'){echo 'Contact Me/Us';} else
                  if ($tab=='deviant'){echo 'Deviant Art';} else
                  if ($tab=='instagram'){echo 'Instagram';} else
                  if ($tab=='vimeo'){echo 'Vimeo';} else
                  if ($tab=='tumblr'){echo 'Tumblr';} else
                  if ($tab=='custom'){echo $wpl_Custom.' #1';}
                  if ($tab=='custom2'){echo $wpl_Custom.' #2';}
                  if ($tab=='custom3'){echo $wpl_Custom.' #3';}
                  if ($tab=='custom4'){echo $wpl_Custom.' #4';} 
                  ?>        
                </h3>
                <div class="inside">
                  <table cellpadding="3">
                    <?php
                    if ($tab=='facebook'){                  
                      wpfb_form_input('wpflybox_facebook','70',$wpl_FullPageURL,'('.$wpl_FannotPersonal.')');
                      $wpfb_choices=array($wpl_Light => 'light', $wpl_Dark => 'dark');
                      wpfb_form_option('wpflybox_facebook_color',$wpl_ColorScheme,'',$wpfb_choices);
                      wpfb_form_input('wpflybox_facebook_height','6',$wpl_Height,'px');
                      wpfb_form_input('wpflybox_facebook_width','6',$wpl_Width,'px');
                      $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                      wpfb_form_option('wpflybox_facebook_header',$wpl_ShowHeader,$wpl_IsHeader,$wpfb_choices);
                      $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                      wpfb_form_option('wpflybox_facebook_stream',$wpl_ShowStream,'',$wpfb_choices);
                      $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                      wpfb_form_option('wpflybox_facebook_showfaces',$wpl_ShowFaces,'',$wpfb_choices);
                      $wpfb_choices=array($wpl_Large => 'false', $wpl_Small => 'true');
                      wpfb_form_option('wpflybox_facebook_header_size',$wpl_HeaderSize,'',$wpfb_choices);
                      $wpfb_choices=array($wpl_Show => 'false', $wpl_Hide => 'true');
                      wpfb_form_option('wpflybox_facebook_hide_cover',$wpl_HideCover,'',$wpfb_choices);
                      $wpfb_choices=array($wpl_Show => 'false', $wpl_Hide => 'true');
                      wpfb_form_option('wpflybox_facebook_hide_cta',$wpl_Cta,$wpl_Cta_Desc,$wpfb_choices);
                      wpfb_form_input('wpflybox_facebook_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_facebook_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_facebook_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_facebook_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_facebook_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_facebook_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_facebook_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);
                    } else if ($tab=='twitter'){
                      wpfb_form_input('wpflybox_twitter','20',$wpl_TwitterUsername,'');
                      wpfb_form_input('wpflybox_twitter_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_twitter_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);                      
                      $wpfb_choices=array($wpl_Followers => 'followers', $wpl_Friends => 'friends');
                      wpfb_form_option('wpflybox_twitter_showfollowers',$wpl_ShowWhat,'',$wpfb_choices);
                      wpfb_form_input('wpflybox_twitter_count','2',$wpl_HowManyFF,$wpl_Use0Friends);
                      $wpfb_choices=array($wpl_On => 'on', $wpl_Off => 'off');
                      wpfb_form_option('wpflybox_twitter_link',$wpl_ProvideLinktoF,'',$wpfb_choices);
                      $wpfb_choices=array($wpl_On => 'on', $wpl_Off => 'off');
                      wpfb_form_option('wpflybox_twitter_tweetto',$wpl_TweettoButton,'',$wpfb_choices);
                      $wpfb_choices=array($wpl_On => 'true', $wpl_Off => 'false');
                      wpfb_form_option('wpflybox_twitter_latest',$wpl_ShowLatestT,'',$wpfb_choices);
                      wpfb_form_input('wpflybox_twitter_customheight','3',$wpl_twitterheight,$wpl_twitterheightdesc);
                      if (get_option('wpflybox_usecustombutton')=='true')
                        {
                        $wpfb_choices=array($wpl_Twitter_Bird => 'twitter_custom', $wpl_Twitter_T => 'twitter');
                        wpfb_form_option('wpflybox_twitter_custom_button',$wpl_Twitter_Button,'',$wpfb_choices);
                        }
                      echo '<tr><td colspan="2"><hr /></td></tr>';  
                      wpfb_form_input('wpflybox_my_twitter_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_twitter_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_twitter_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_twitter_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);  
                      echo '<tr><td colspan="2">*'.$wpl_DeleteCacheAfterUpdate.'</td></tr>';
                      wpfb_form_textarea('wpflybox_twitter_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);
                    } else if ($tab=='googleplus'){
                      wpfb_form_input('wpflybox_google','40',$wpl_Googlenumuser,$wpl_Googleuserdesc);
                      $wpfb_choices=array($wpl_Profile => 'person', $wpl_Page => 'page', $wpl_Community => 'community');
                      wpfb_form_option('wpflybox_google_type',$wpl_PageType,$wpl_GooglePagedesc,$wpfb_choices);
                      $wpfb_choices=array($wpl_Portrait => 'portrait', $wpl_Landscape => 'landscape');
                      wpfb_form_option('wpflybox_google_layout',$wpl_Layout,'',$wpfb_choices);
                      $wpfb_choices=array($wpl_GoogleLight => 'light', $wpl_GoogleDark => 'dark');
                      wpfb_form_option('wpflybox_google_theme',$wpl_GoogleTheme,'',$wpfb_choices);
                      $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                      wpfb_form_option('wpflybox_google_showcover',$wpl_GoogleShowCover,'',$wpfb_choices);
                      $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                      wpfb_form_option('wpflybox_google_showtag',$wpl_GoogleShowTag,'',$wpfb_choices);
                      wpfb_form_input('wpflybox_googleplus_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_googleplus_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>'; 
                      wpfb_form_input('wpflybox_my_googleplus_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_googleplus_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_googleplus_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_googleplus_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_googleplus_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);                     
                    } else if ($tab=='youtube'){
                      wpfb_form_input('wpflybox_youtube','30',$wpl_YoutubeUsername,'You can find your user ID at <a href="https://www.youtube.com/account_advanced" target="_blank">https://www.youtube.com/account_advanced</a>.');
                      wpfb_form_input('wpflybox_youtube_channel','30',$wpl_YoutubeChannel,'Set User ID to blank to use a channel ID, can be found by URL, ex: https://www.youtube.com/channel/XXXXXXXXXXXXXXXX. This can also be a user ID if you just like this layout better.');
                      wpfb_form_input('wpflybox_youtube_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_youtube_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_youtube_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_youtube_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_youtube_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_youtube_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_youtube_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);                      
                    } else if ($tab=='subscription'){
                      wpfb_form_input('wpflybox_feedburner','30',$wpl_FeedburnerUsername,$wpl_FeedburnerUsernameDesc);
                      wpfb_form_input('wpflybox_subscription_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_subscription_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_my_subscription_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_subscription_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_subscription_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_subscription_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_subscription_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>';                      
                    } else if ($tab=='pinterest'){
                      wpfb_form_input('wpflybox_pinterest','30',$wpl_PinterestUsername,$wpl_PinterestUserDesc);
                      wpfb_form_input('wpflybox_pinterest_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_pinterest_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_pinterest_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_pinterest_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_pinterest_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_pinterest_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight); 
                      wpfb_form_textarea('wpflybox_pinterest_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);                     
                    } else if ($tab=='linkedin'){
                      wpfb_form_input('wpflybox_linkedin','50',$wpl_LinkedinID,'<br />'.$wpl_LinkedinFindID);
                      $wpfb_choices=array($wpl_Member => 'member', $wpl_Company => 'company');
                      wpfb_form_option('wpflybox_linkedin_type',$wpl_LinkedinMember,'',$wpfb_choices);
                      wpfb_form_input('wpflybox_linkedin_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_linkedin_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_linkedin_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_linkedin_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_linkedin_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_linkedin_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_linkedin_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);                      
                    } else if ($tab=='flickr'){
                      $wpfb_choices=array($wpl_Flash => 'flash', $wpl_Static => 'static');
                      wpfb_form_option('wpflybox_flickr_type',$wpl_FlickrType,$wpl_FlickrTypeDesc,$wpfb_choices);
                      wpfb_form_input('wpflybox_flickr','20',$wpl_FlickrID,$wpl_FlickerIDGetter.': <a href="http://idgettr.com/" target="_blank">http://idgettr.com/</a>.');
                      wpfb_form_input('wpflybox_flickr_tag','20',$wpl_PhotoTag,$wpl_PhotoTagDesc);
                      wpfb_form_input('wpflybox_flickr_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_flickr_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_flickr_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_flickr_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_flickr_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_flickr_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_flickr_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);                      
                    } else if ($tab=='contact'){
                      wpfb_form_input('wpflybox_contactemail','70',$wpl_CompletedForm,'');
                      $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                      wpfb_form_option('wpflybox_captcha',$wpl_UseCaptcha,'',$wpfb_choices);
                      $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                      wpfb_form_option('wpflybox_recaptcha','Use ReCaptcha by Goodle','',$wpfb_choices);
                      if (get_option('wpflybox_recaptcha') == "true") {
                        wpfb_form_input('wpflybox_recaptcha_public','50','ReCaptcha Public/Site Key','<a href="https://www.google.com/recaptcha/admin#createsite" target="_blank">Get Keys</a>');
                        wpfb_form_input('wpflybox_recaptcha_private','50','ReCaptcha Private Key','<a href="https://www.google.com/recaptcha/admin#createsite" target="_blank">Get Keys</a>');
                      }
                      
                      $wpfb_choices=array($wpl_ContactMe => 'me', $wpl_ContactUs => 'us');
                      wpfb_form_option('wpflybox_contactwho',$wpl_TabWording,'',$wpfb_choices);
                      wpfb_form_input('wpflybox_contact_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_contact_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_contact_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_contact_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_contact_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_contact_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_contact_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);   
                      echo '<tr><td colspan="2"></br>CSS IDs of each element: wpfb_contactMe, wpfb_name, wpfb_email, wpfb_message, wpfb_captcha, wpfb_submit</td></tr>';                   
                    } else if ($tab=='deviant'){
                      wpfb_form_input('wpflybox_deviant_username','30',$wpl_DeviantUser,'');
                      wpfb_form_input('wpflybox_deviant_limit','3',$wpl_DevMaxNum,'('.$wpl_DevMaxNumDesc.')');
                      wpfb_form_input('wpflybox_deviant_max_width','3',$wpl_DevMaxWidth,'px '.$wpl_DevMaxWidthDesc);
                      wpfb_form_input('wpflybox_deviant_max_height','3',$wpl_DevMaxHeight,'px '.$wpl_DevMaxHeightDesc);
                      wpfb_form_input('wpflybox_deviant_columns','3',$wpl_DevCol,'');
                      wpfb_form_input('wpflybox_deviant_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_deviant_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_deviant_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_deviant_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_deviant_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_deviant_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_deviant_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);
                      echo '<tr><td colspan="2">*'.$wpl_DeleteCacheAfterUpdate.'</td></tr>';                      
                    } else if ($tab=='instagram'){
                      echo '<tr><td colspan="2">'.$wpl_ToAuthorize.'</td></tr>';
                      wpfb_form_input('wpflybox_instagram_id','30',$wpl_InstUserID,'<a href="http://njarb.com/wp-flybox/instagram" target="_blank">'.$wpl_InstGetIDHere.'</a>');
                      wpfb_form_input('wpflybox_instagram_token','70',$wpl_InstAuth,'<a href="http://njarb.com/wp-flybox/instagram" target="_blank">'.$wpl_InstGetAuthHere.'</a>');
                      wpfb_form_input('wpflybox_instagram_max','2',$wpl_InstMaxRecent,$wpl_InstHowManyPics);
                      $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                      wpfb_form_option('wpflybox_instagram_header',$wpl_ShowHeader,'',$wpfb_choices);
                      wpfb_form_input('wpflybox_instagram_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_instagram_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_instagram_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_instagram_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_instagram_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_instagram_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_instagram_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);
                      echo '<tr><td colspan="2">*'.$wpl_DeleteCacheAfterUpdate.'</td></tr>';                                            
                    } else if ($tab=='vimeo'){
                      wpfb_form_input('wpflybox_vimeo_username','30',$wpl_VimUser,'');
                      wpfb_form_input('wpflybox_vimeo_total','2',$wpl_VimVideotoShow,$wpl_VimZerotoShowNo);
                      wpfb_form_input('wpflybox_vimeo_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_vimeo_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_vimeo_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_vimeo_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_vimeo_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_vimeo_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_vimeo_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);
                      echo '<tr><td colspan="2">*'.$wpl_DeleteCacheAfterUpdate.'</td></tr>';                      
                    } else if ($tab=='custom'){
                      wpfb_form_textarea('wpflybox_custom_content','8', '40', $wpl_CustomContent,$wpl_CustomContentDesc);
                      $wpfb_choices=array('URL Link' => 'true', 'HTML Code' => 'false');
                      wpfb_form_option('wpflybox_custom_URL_instead',$wpl_URL_Instead,'',$wpfb_choices);
                      $wpfb_choices=array('Yes' => 'true', 'No' => 'false');
                      wpfb_form_option('wpflybox_custom_URL_new_wind','Open URL in New Tab','',$wpfb_choices);
                      echo '<tr><td></td><td><b>'.$wpl_URL_Instead_Desc.'</b></td></tr>';
                      echo '<tr><td style="text-align:right;" width="190px"><b>'.$wpl_CustomIcon.':</b></td>';
                      $wpfb_icon_array=array('accept.png','add.png','apple.png','arrow_down.png','arrow_left.png','arrow_right.png','arrow_up.png','attachment.png','battery.png','battery_full.png','battery_low.png','briefcase.png','calculator.png','calendar_blank.png','calendar_full.png','chart.png','chart_pie.png','chess.png','clock.png','cloud_comment.png','coffee.png','comment.png','comments.png','computer.png','copy_page.png','cut.png','delete.png','dollar.png','edit.png','eject.png','email.png','euro.png','exclamation.png','fast_forward.png','favorite.png','flag.png','folder.png','games.png','heart.png','help.png','home.png','info.png','ipod.png','key.png','link.png','lock.png','mail.png','map.png','microphone.png','minus.png','mobile_phone.png','mouse.png','music_note.png','new.png','new_page.png','notebook.png','old_clock.png','old_phone.png','page.png','paint_brush.png','pause.png','phone.png','photo_camera.png','play.png','print.png','process.png','puzzle.png','record.png','refresh.png','remove.png','repeat.png','rewind.png','rss.png','save.png','search.png','security.png','shopping_cart.png','shut_down.png','skip_backward.png','skip_forward.png','sterling_pound.png','stop.png','target.png','television.png','tools.png','trash.png','umbrella.png','unlock.png','user.png','users.png','video_camera.png','volume_down.png','volume_up.png','warning.png','webcam.png','wired.png','wireless.png','yen.png','zoom_in.png','zoom_out.png'); 
                      echo '<td>';
                      foreach ($wpfb_icon_array as &$value) {
                        echo '<div style="display:inline-block;padding-right:15px;"><input type="radio" name="wpflybox_custom_icon" value="'.$value.'" id="wpfb_'.$value.'"';
                        if (get_option('wpflybox_custom_icon')==$value)
                          {
                          echo ' checked';
                          }
                        echo ' />';
                        echo '<label for="wpfb_'.$value.'"><img src="'.plugins_url().'/wp-flybox/static/icons/custom/'.$value.'" style="width:30px;height:30px;" /></label>';
                        echo '</div>';
                        }  
                      echo $wpl_CustomIconDesc.'</td></tr>';                                           
                      wpfb_form_input('wpflybox_custom_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_custom_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc); 
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_custom_tab','50',$wpl_CustomIconUpload,$wpl_CustomIconUploadDesc); 
                      wpfb_form_input('wpflybox_my_custom_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc);
                      wpfb_form_input('wpflybox_my_custom_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_custom_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight); 
                      wpfb_form_textarea('wpflybox_custom_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);                                         
                    } else if ($tab=='tumblr'){
                      wpfb_form_input('wpflybox_tumblr','30',$wpl_Tumblr,$wpl_Tumblr_Desc);
                      wpfb_form_input('wpflybox_tumblr_max','3',$wpl_Tumblr_Max,'');
                      wpfb_form_input('wpflybox_tumblr_height','6',$wpl_Height,'px');
                      wpfb_form_input('wpflybox_tumblr_width','6',$wpl_Width,'px');
                      wpfb_form_input('wpflybox_tumblr_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_tumblr_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc);
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_tumblr_tab','50',$wpl_MyTab,$wpl_MyTabDesc);
                      wpfb_form_input('wpflybox_my_tumblr_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_tumblr_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_tumblr_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);
                      echo '<tr><td colspan="2">*'.$wpl_DeleteCacheAfterUpdate.'</td></tr>';                      
                    } else if ($tab=='custom2'){
                      wpfb_form_textarea('wpflybox_custom2_content','8', '40', $wpl_CustomContent,$wpl_CustomContentDesc);
                      $wpfb_choices=array('URL Link' => 'true', 'HTML Code' => 'false');
                      wpfb_form_option('wpflybox_custom2_URL_instead',$wpl_URL_Instead,'',$wpfb_choices);
                      $wpfb_choices=array('Yes' => 'true', 'No' => 'false');
                      wpfb_form_option('wpflybox_custom2_URL_new_wind','Open URL in New Tab','',$wpfb_choices);
                      echo '<tr><td></td><td><b>'.$wpl_URL_Instead_Desc.'</b></td></tr>';
                      echo '<tr><td style="text-align:right;" width="190px"><b>'.$wpl_CustomIcon.':</b></td>';
                      $wpfb_icon_array=array('accept.png','add.png','apple.png','arrow_down.png','arrow_left.png','arrow_right.png','arrow_up.png','attachment.png','battery.png','battery_full.png','battery_low.png','briefcase.png','calculator.png','calendar_blank.png','calendar_full.png','chart.png','chart_pie.png','chess.png','clock.png','cloud_comment.png','coffee.png','comment.png','comments.png','computer.png','copy_page.png','cut.png','delete.png','dollar.png','edit.png','eject.png','email.png','euro.png','exclamation.png','fast_forward.png','favorite.png','flag.png','folder.png','games.png','heart.png','help.png','home.png','info.png','ipod.png','key.png','link.png','lock.png','mail.png','map.png','microphone.png','minus.png','mobile_phone.png','mouse.png','music_note.png','new.png','new_page.png','notebook.png','old_clock.png','old_phone.png','page.png','paint_brush.png','pause.png','phone.png','photo_camera.png','play.png','print.png','process.png','puzzle.png','record.png','refresh.png','remove.png','repeat.png','rewind.png','rss.png','save.png','search.png','security.png','shopping_cart.png','shut_down.png','skip_backward.png','skip_forward.png','sterling_pound.png','stop.png','target.png','television.png','tools.png','trash.png','umbrella.png','unlock.png','user.png','users.png','video_camera.png','volume_down.png','volume_up.png','warning.png','webcam.png','wired.png','wireless.png','yen.png','zoom_in.png','zoom_out.png'); 
                      echo '<td>';
                      foreach ($wpfb_icon_array as &$value) {
                        echo '<div style="display:inline-block;padding-right:15px;"><input type="radio" name="wpflybox_custom2_icon" value="'.$value.'" id="wpfb_'.$value.'"';
                        if (get_option('wpflybox_custom2_icon')==$value)
                          {
                          echo ' checked';
                          }
                        echo ' />';
                        echo '<label for="wpfb_'.$value.'"><img src="'.plugins_url().'/wp-flybox/static/icons/custom/'.$value.'" style="width:30px;height:30px;" /></label>';
                        echo '</div>';
                        }  
                      echo $wpl_CustomIconDesc.'</td></tr>';                                           
                      wpfb_form_input('wpflybox_custom2_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_custom2_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc); 
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_custom2_tab','50',$wpl_CustomIconUpload,$wpl_CustomIconUploadDesc);
                      wpfb_form_input('wpflybox_my_custom2_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc); 
                      wpfb_form_input('wpflybox_my_custom2_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_custom2_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_custom2_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);                                          
                    } else if ($tab=='custom3'){
                      wpfb_form_textarea('wpflybox_custom3_content','8', '40', $wpl_CustomContent,$wpl_CustomContentDesc);
                      $wpfb_choices=array('URL Link' => 'true', 'HTML Code' => 'false');
                      wpfb_form_option('wpflybox_custom3_URL_instead',$wpl_URL_Instead,'',$wpfb_choices);
                      $wpfb_choices=array('Yes' => 'true', 'No' => 'false');
                      wpfb_form_option('wpflybox_custom3_URL_new_wind','Open URL in New Tab','',$wpfb_choices);
                      echo '<tr><td></td><td><b>'.$wpl_URL_Instead_Desc.'</b></td></tr>';
                      echo '<tr><td style="text-align:right;" width="190px"><b>'.$wpl_CustomIcon.':</b></td>';
                      $wpfb_icon_array=array('accept.png','add.png','apple.png','arrow_down.png','arrow_left.png','arrow_right.png','arrow_up.png','attachment.png','battery.png','battery_full.png','battery_low.png','briefcase.png','calculator.png','calendar_blank.png','calendar_full.png','chart.png','chart_pie.png','chess.png','clock.png','cloud_comment.png','coffee.png','comment.png','comments.png','computer.png','copy_page.png','cut.png','delete.png','dollar.png','edit.png','eject.png','email.png','euro.png','exclamation.png','fast_forward.png','favorite.png','flag.png','folder.png','games.png','heart.png','help.png','home.png','info.png','ipod.png','key.png','link.png','lock.png','mail.png','map.png','microphone.png','minus.png','mobile_phone.png','mouse.png','music_note.png','new.png','new_page.png','notebook.png','old_clock.png','old_phone.png','page.png','paint_brush.png','pause.png','phone.png','photo_camera.png','play.png','print.png','process.png','puzzle.png','record.png','refresh.png','remove.png','repeat.png','rewind.png','rss.png','save.png','search.png','security.png','shopping_cart.png','shut_down.png','skip_backward.png','skip_forward.png','sterling_pound.png','stop.png','target.png','television.png','tools.png','trash.png','umbrella.png','unlock.png','user.png','users.png','video_camera.png','volume_down.png','volume_up.png','warning.png','webcam.png','wired.png','wireless.png','yen.png','zoom_in.png','zoom_out.png'); 
                      echo '<td>';
                      foreach ($wpfb_icon_array as &$value) {
                        echo '<div style="display:inline-block;padding-right:15px;"><input type="radio" name="wpflybox_custom3_icon" value="'.$value.'" id="wpfb_'.$value.'"';
                        if (get_option('wpflybox_custom3_icon')==$value)
                          {
                          echo ' checked';
                          }
                        echo ' />';
                        echo '<label for="wpfb_'.$value.'"><img src="'.plugins_url().'/wp-flybox/static/icons/custom/'.$value.'" style="width:30px;height:30px;" /></label>';
                        echo '</div>';
                        }  
                      echo $wpl_CustomIconDesc.'</td></tr>';                                           
                      wpfb_form_input('wpflybox_custom3_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_custom3_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc); 
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_custom3_tab','50',$wpl_CustomIconUpload,$wpl_CustomIconUploadDesc);
                      wpfb_form_input('wpflybox_my_custom3_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc); 
                      wpfb_form_input('wpflybox_my_custom3_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_custom3_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_custom3_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);                                          
                    } else if ($tab=='custom4'){
                      wpfb_form_textarea('wpflybox_custom4_content','8', '40', $wpl_CustomContent,$wpl_CustomContentDesc);
                      $wpfb_choices=array('URL Link' => 'true', 'HTML Code' => 'false');
                      wpfb_form_option('wpflybox_custom4_URL_instead',$wpl_URL_Instead,'',$wpfb_choices);
                      $wpfb_choices=array('Yes' => 'true', 'No' => 'false');
                      wpfb_form_option('wpflybox_custom4_URL_new_wind','Open URL in New Tab','',$wpfb_choices);
                      echo '<tr><td></td><td><b>'.$wpl_URL_Instead_Desc.'</b></td></tr>';
                      echo '<tr><td style="text-align:right;" width="190px"><b>'.$wpl_CustomIcon.':</b></td>';
                      $wpfb_icon_array=array('accept.png','add.png','apple.png','arrow_down.png','arrow_left.png','arrow_right.png','arrow_up.png','attachment.png','battery.png','battery_full.png','battery_low.png','briefcase.png','calculator.png','calendar_blank.png','calendar_full.png','chart.png','chart_pie.png','chess.png','clock.png','cloud_comment.png','coffee.png','comment.png','comments.png','computer.png','copy_page.png','cut.png','delete.png','dollar.png','edit.png','eject.png','email.png','euro.png','exclamation.png','fast_forward.png','favorite.png','flag.png','folder.png','games.png','heart.png','help.png','home.png','info.png','ipod.png','key.png','link.png','lock.png','mail.png','map.png','microphone.png','minus.png','mobile_phone.png','mouse.png','music_note.png','new.png','new_page.png','notebook.png','old_clock.png','old_phone.png','page.png','paint_brush.png','pause.png','phone.png','photo_camera.png','play.png','print.png','process.png','puzzle.png','record.png','refresh.png','remove.png','repeat.png','rewind.png','rss.png','save.png','search.png','security.png','shopping_cart.png','shut_down.png','skip_backward.png','skip_forward.png','sterling_pound.png','stop.png','target.png','television.png','tools.png','trash.png','umbrella.png','unlock.png','user.png','users.png','video_camera.png','volume_down.png','volume_up.png','warning.png','webcam.png','wired.png','wireless.png','yen.png','zoom_in.png','zoom_out.png'); 
                      echo '<td>';
                      foreach ($wpfb_icon_array as &$value) {
                        echo '<div style="display:inline-block;padding-right:15px;"><input type="radio" name="wpflybox_custom4_icon" value="'.$value.'" id="wpfb_'.$value.'"';
                        if (get_option('wpflybox_custom4_icon')==$value)
                          {
                          echo ' checked';
                          }
                        echo ' />';
                        echo '<label for="wpfb_'.$value.'"><img src="'.plugins_url().'/wp-flybox/static/icons/custom/'.$value.'" style="width:30px;height:30px;" /></label>';
                        echo '</div>';
                        }  
                      echo $wpl_CustomIconDesc.'</td></tr>';                                           
                      wpfb_form_input('wpflybox_custom4_background','10',$wpl_BackgroundColor,$wpl_BackgroundColorDesc);
                      wpfb_form_input('wpflybox_custom4_border','10',$wpl_BorderColor,$wpl_BackgroundColorDesc); 
                      echo '<tr><td colspan="2"><hr /></td></tr>';
                      wpfb_form_input('wpflybox_my_custom4_tab','50',$wpl_CustomIconUpload,$wpl_CustomIconUploadDesc);
                      wpfb_form_input('wpflybox_my_custom4_tab_open','50',$wpl_MyTabOpen,$wpl_MyTabOpenDesc); 
                      wpfb_form_input('wpflybox_my_custom4_tab_width','5',$wpl_MyTabWidth,$wpl_MyTabDescWidth);
                      wpfb_form_input('wpflybox_my_custom4_tab_height','5',$wpl_MyTabHeight,$wpl_MyTabDescHeight);
                      wpfb_form_textarea('wpflybox_custom4_onclick_js','3', '40', $wpl_onClickJS,$wpl_onClickJSDesc);                                          
                    }
                    ?>
                  </table>
                </div>
              </div>
            </div>
          <?php
          $wpfb_i++;
        }
        ?>
      <p class="submit">
        <input class="button-primary" type="submit" name="Submit" value="<?php echo $wpl_UpdateAllOptions; ?>" />
      </p>  
      </div>   
    </form>    
  </div>
  <?php		
	}	
if ($wpfb_active_tab=='other')
  {
  ?>
  <div class="postbox-container">
    <div class="metabox-holder">
      <div class="meta-box">
        <div class="postbox" style="width:100%;">
          <div class="inside">
            <form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
              <table cellpadding="3">
                <?php                
                echo '<tr><td colspan="2"><h4>'.$wpl_MobileSupport.':</h4></td></tr>';
                $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                wpfb_form_option('wpflybox_mobile',$wpl_EnableForMobile,'',$wpfb_choices); 
                echo '<tr><td colspan="2"><h4>'.$wpl_TabletSupport.':</h4></td></tr>';
                $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                wpfb_form_option('wpflybox_tablet',$wpl_EnableforTablets,'',$wpfb_choices);
                echo '<tr><td colspan="2"><h4>'.$wpl_Scrolling.':</h4></td></tr>';
                $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                wpfb_form_option('wpflybox_scrollingfix',$wpl_ScrollingFix,$wpl_ScrollingFixDesc,$wpfb_choices);
                //wpfb_form_input('wpflybox_scollingfix_toomuch','5',$wpl_ScrollingTooMuch,$wpl_ScrollingTooMuchDesc);
                //wpfb_form_input('wpflybox_scollingfix_minheight','5',$wpl_ScrollingMinHeight,$wpl_ScrollingMinHeightDesc);
                echo '<tr><td colspan="2"><h4>'.$wpl_Caching.':</h4></td></tr>';
                echo '<tr><td colspan="2">'.$wpl_CacheDesc.'</td></tr>';
                echo '<tr><td style="text-align:right;"><b>'.$wpl_DeleteCaches.'</b></td>';
                echo '<td>'; 
                wpfb_form_checkbox('wpflybox_delete_cache','',$wpl_ChecktoDelete);
                echo '</td></tr>';  
                echo '<tr><td colspan="2"><h4>jQuery:</h4></td></tr>';
                $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                wpfb_form_option('wpflybox_enque_jquery',$wpl_EnqueJquery,$wpl_EnqueJqueryDesc,$wpfb_choices);
                echo '<tr><td colspan="2"><h4>Debug:</h4></td></tr>';
                $wpfb_choices=array($wpl_Yes => 'true', $wpl_No => 'false');
                wpfb_form_option('wpflybox_debug','Turn on Debugger?','Exports all option values as a comment in header.',$wpfb_choices);
                ?>
                <tr>
                  <td>
                    <p class="submit">
  				            <input class="button-primary" type="submit" name="Submit" value="<?php echo $wpl_UpdateOptions; ?>" />
  				          </p>
                  </td>
                </tr>                                  
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php		
	}	
if ($wpfb_active_tab=='help')
  {
  ?>
  <div class="postbox-container">
    <div class="metabox-holder">
      <div class="meta-box">
        <div class="postbox" style="width:100%;">
          <div class="inside">
            <?php               
            echo '<h4>'.$wpl_Help.':</h4>';
            echo 'Find an error or want something added? Let me know!';
            echo '<br />Create a support topic on the <a href="http://wordpress.org/extend/plugins/wp-flybox/" target="blank">Wordpress plugin page</a>';
            echo '<br />Comment on the <a href="http://njarb.com/2012/08/wp-flybox/" target="blank">plugin blog post</a>';
            echo '<br /><br />';
            echo '<h4>Find Me On:</h4>';
            echo '<a href="http://facebook.com/cylec" target="_blank">Facebook</a>';
            echo '<br /><a href="http://twitter.com/cyleconoly" target="_blank">Twitter</a>';
            echo '<br /><a href="http://plus.google.com/u/0/105734435204105331709" target="_blank">Google Plus</a>';
            echo '<br /><br />';
            echo '<h4>Rate:</h4>';
            echo '<a href="http://wordpress.org/extend/plugins/wp-flybox/" target="blank">Rate this plugin</a>';
            echo '<br /><br />';
            echo '<h4>Donate:</h4>';
            echo 'I don\'t really care about any donations, but if you like this plugin a <a href="http://wordpress.org/extend/plugins/wp-flybox/" target="blank">good rating</a> would be very much appreciated!';
            ?>
            <br /><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_s-xclick">
              <input type="hidden" name="hosted_button_id" value="DAP6N4DSPBDMY">
              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php		
	}	
?>