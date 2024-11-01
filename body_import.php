<?php
if (!class_exists('Mobile_Detect', false))
  {
  require_once 'includes/Mobile_Detect.php';
  }
$detect = new Mobile_Detect;
if ((get_option('wpflybox_mobile')=='true' && $detect->isMobile() && !$detect->isTablet()) || (get_option('wpflybox_tablet')=='true' && $detect->isTablet()) || !$detect->isMobile())
{
include('lang/'.get_option('wpflybox_language').'.php');
$number_of_tabs=get_option('wpflybox_count');

if (get_option('wpflybox_usecustombutton')=='true')
  {
  $tab_height=34;
  } else {
  $tab_height=101;
  }
$top_margin=intval(get_option('wpflybox_start'));

if (is_admin_bar_showing()){$top_margin=$top_margin+32;}
$tab_spacing=intval(get_option('wpflybox_seperation'));
$right_or_left=get_option('wpflybox_side');
$use_custom_button=get_option('wpflybox_usecustombutton');
if ($right_or_left=='left'){$opposite_right_or_left='right';}else{$opposite_right_or_left='left';}
$plugin_url=plugins_url();
$i=1;
$tabs=Array();
$my_tab_width=Array();
$my_tab_max_width=0;
while($i<=$number_of_tabs)
  {
  $tabs[$i]=get_option('wpflybox_tab'.$i);
  if (get_option('wpflybox_my_'.$tabs[$i].'_tab') !='')
    {
    $my_tab_width[$i]=intval(get_option('wpflybox_my_'.$tabs[$i].'_tab_width'));
    } else {
    $my_tab_width[$i]=32;
    }
  if($my_tab_width[$i]>$my_tab_max_width)
    {
    $my_tab_max_width=$my_tab_width[$i];
    }      
  $i++;
  }
$i=1;
$wpflybox_position=get_option('wpflybox_position');
if ($wpflybox_position !== "fixed" && $wpflybox_position !=="absolute"){$wpflybox_position="fixed";}
//echo '<div style="height: 100%;margin: 0;overflow:hidden;padding: 0;position: absolute;width: 100%;top:0px;">';
$tab_heights=array();
$tab_heights[0]=0;

if (get_option('wpflybox_scrollingfix')=='true')
  {
  echo '<div id="wpflybox_container" style="width:100%;min-height:100%;position:'.$wpflybox_position.';overflow:hidden;top:0;left:0;right:0;bottom:0;pointer-events: none;background: url(\''.$plugin_url.'/wp-flybox/static/transparent.png\');filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.$plugin_url.'/wp-flybox/static/transparent.png\', sizingMethod=\'scale\');background: none !important;z-index:9989 !important;">';
  }

while ($i<=$number_of_tabs)
  {
  //wrapper
  echo '<div class="wp-flybox_tab" id="wp-flybox_tab'.$i.'" style="pointer-events:all;width:auto;display:inline-block;overflow:hidden;position:'.$wpflybox_position.';border:0px;'.$right_or_left.':-9990px;top:';
  if ($i==1)
    {
    if(get_option('wpflybox_my_'.$tabs[$i].'_tab') !='')
      {
      $tab_heights[$i]=$tab_heights[$i-1]+intval(get_option('wpflybox_my_'.$tabs[$i].'_tab_height'));
      }else if(strpos($tabs[$i],'custom')!==false){
      $tab_heights[$i]=$tab_heights[$i-1]+32;
      }else{
      $tab_heights[$i]=$tab_heights[$i-1]+$tab_height;
      }
    echo $top_margin;
    }else{
    if(get_option('wpflybox_my_'.$tabs[$i].'_tab') !='')
      {
      $tab_heights[$i]=$tab_heights[$i-1]+intval(get_option('wpflybox_my_'.$tabs[$i].'_tab_height'));
      }else if(strpos($tabs[$i],'custom')!==false){
      $tab_heights[$i]=$tab_heights[$i-1]+32;
      }else{
      $tab_heights[$i]=$tab_heights[$i-1]+$tab_height;
      }
    $new_spacing = $top_margin+$tab_spacing*($i-1)+$tab_heights[$i-1];
    echo $new_spacing;
    }
  if((get_option('wpflybox_my_'.$tabs[$i].'_tab')=='' && get_option('wpflybox_usecustombutton')=='true') || (strpos($tabs[$i],'custom')!==false && get_option('wpflybox_my_'.$tabs[$i].'_tab')==''))
  {
  $class='wpflybox_button wp_but';
  }else{
  $class='wp_but';
  }  
    
  echo 'px;z-index:999'.$i.' !important">';
  //filler
  if(get_option('wpflybox_remove_filler') != 'true') 
    {
    echo '<div style="height:10px;width:'.$my_tab_max_width.'px;display:';
    if ($number_of_tabs>1)
      {
      echo 'inline-block;';
      }else{
      echo 'none;';
      }
      echo 'inline-block;float:'.$right_or_left.';"></div>';
    }
  //click image tab
  echo '<div class="'.$class.'" style="display:inline-block;float:'.$opposite_right_or_left.';cursor:pointer;">';
  include ('includes/'.$tabs[$i].'_tab.php');
  echo '</div>';
  //content
  echo '<div style="float:'.$opposite_right_or_left.';">';
  include ('includes/'.$tabs[$i].'_content.php');
  echo '</div></div>';
  $i++;
  }
if (get_option('wpflybox_scrollingfix')=='true')
  {
  echo '</div>';
  }  
//echo '</div>';
}//end mobile
?>