<?php
$wpflybox_open_in = '_self';
if (get_option('wpflybox_custom_URL_new_wind')==='true'){$wpflybox_open_in = '_blank';}
if (get_option('wpflybox_custom4_URL_instead')==='true'){echo '<a href="'.stripslashes(get_option('wpflybox_custom4_content')).'" target="'.$wpflybox_open_in.'">';}
if (get_option('wpflybox_my_custom4_tab')!='')
  {
  $wpflybox_custom4_tab_height=intval(get_option('wpflybox_my_custom4_tab_height'));
  $wpflybox_custom4_tab_width=intval(get_option('wpflybox_my_custom4_tab_width'));
  }else 
  {
  $wpflybox_custom4_tab_height=32;
  $wpflybox_custom4_tab_width=32;
  }
if (get_option('wpflybox_my_custom4_tab')=='')
  {
  if (get_option('wpflybox_usecustombutton') == "false")
  {
  echo '<style type="text/css">';
  $wpflybox_bgtopgradient=get_option('wpflybox_bgtopgradient');		
  $wpflybox_bgbottomgradient=get_option('wpflybox_bgbottomgradient');       			
  $wpflybox_bgborder=get_option('wpflybox_bgborder');
  $wpflybox_side=get_option('wpflybox_side');
if ($wpflybox_side=='right')
  {
  $wpflybox_side_operator = '-';
  } else {
  $wpflybox_side_operator = '';
  }
  echo '.wpflybox_button img{
   border-top: 1px solid #'.$wpflybox_bgborder.';';
   if ($wpflybox_side=='left')
    {
    echo 'border-right: 1px solid #'.$wpflybox_bgborder.';';
    } else {
    echo 'border-left: 1px solid #'.$wpflybox_bgborder.';';
    }
   echo 'direction:ltr;
   border-bottom: 1px solid #'.$wpflybox_bgborder.';
   background: #000000;
   background: -webkit-gradient(linear, right top, left top, from(#'.$wpflybox_bgtopgradient.'), to(#'.$wpflybox_bgbottomgradient.'));
   background: -webkit-linear-gradient(right, #'.$wpflybox_bgtopgradient.', #'.$wpflybox_bgbottomgradient.');
   background: -moz-linear-gradient(right, #'.$wpflybox_bgtopgradient.', #'.$wpflybox_bgbottomgradient.');
   background: -ms-linear-gradient(right, #'.$wpflybox_bgtopgradient.', #'.$wpflybox_bgbottomgradient.');
   background: -o-linear-gradient(right, #'.$wpflybox_bgtopgradient.', #'.$wpflybox_bgbottomgradient.');
   background: linear-gradient(to right, #'.$wpflybox_bgtopgradient.', #'.$wpflybox_bgbottomgradient.');
   filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr=\'#'.$wpflybox_bgtopgradient.'\', endColorstr=\'#'.$wpflybox_bgbottomgradient.'\');
   -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr=\'#'.$wpflybox_bgtopgradient.'\', endColorstr=\'#'.$wpflybox_bgbottomgradient.'\')"; 
   display:block;
   height:32px;
   width: 32px;
   margin: 0px;
   padding: 0px;';
   if ($wpflybox_side=='left')
    {
    echo '-webkit-border-radius: 0px 9px 9px 0px;
   -moz-border-radius: 0px 9px 9px 0px;
   border-radius: 0px 9px 9px 0px;';
   } else {
   echo '-webkit-border-radius: 9px 0px 0px 9px;
   -moz-border-radius: 9px 0px 0px 9px;
   border-radius: 9px 0px 0px 9px;';
   }
   echo 'color: #ffffff;
   font-size: 10px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: middle;
   z-index:999999;
   }
  .wpflybox_button img{
   padding:0px;
   }
   .wpflybox_button img:hover {';
   if ($wpflybox_side=='left')
    {
    echo '-webkit-border-radius: 0px 9px 9px 0px;
   -moz-border-radius: 0px 9px 9px 0px;
   border-radius: 0px 9px 9px 0px;';
   } else {
   echo '-webkit-border-radius: 9px 0px 0px 9px;
   -moz-border-radius: 9px 0px 0px 9px;
   border-radius: 9px 0px 0px 9px;';
   } 
   echo '   border-top: 1px solid #'.$wpflybox_bgborder.';';
   if ($wpflybox_side=='left')
    {
    echo 'border-right: 1px solid #'.$wpflybox_bgborder.';';
    } else {
    echo 'border-left: 1px solid #'.$wpflybox_bgborder.';';
    }echo 'border-bottom: 1px solid #'.$wpflybox_bgborder.';
   direction:ltr;
   padding:0px;   
   background: #000000;
   background: -webkit-gradient(linear, right top, left top, from(#'.$wpflybox_bgtopgradient.'), to(#'.$wpflybox_bgbottomgradient.'));
   background: -webkit-linear-gradient(right, #'.$wpflybox_bgtopgradient.', #'.$wpflybox_bgbottomgradient.');
   background: -moz-linear-gradient(right, #'.$wpflybox_bgtopgradient.', #'.$wpflybox_bgbottomgradient.');
   background: -ms-linear-gradient(right, #'.$wpflybox_bgtopgradient.', #'.$wpflybox_bgbottomgradient.');
   background: -o-linear-gradient(right, #'.$wpflybox_bgtopgradient.', #'.$wpflybox_bgbottomgradient.');
   background: linear-gradient(to right, #'.$wpflybox_bgtopgradient.', #'.$wpflybox_bgbottomgradient.');
   filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr=\'#'.$wpflybox_bgtopgradient.'\', endColorstr=\'#'.$wpflybox_bgbottomgradient.'\');
   -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr=\'#'.$wpflybox_bgtopgradient.'\', endColorstr=\'#'.$wpflybox_bgbottomgradient.'\')";   
   color: #000000;
   }';
  echo '</style>';
  }
  echo '<img src="'.plugins_url().'/wp-flybox/static/icons/custom/'.get_option('wpflybox_custom4_icon').'" style="width:28px;height:28px;padding:2px;" alt="?">';
  } else {
  echo '<img id="wpfb_tab_img'.$i.'" src="'.get_option('wpflybox_my_custom4_tab').'" style="width:'.$wpflybox_custom4_tab_width.'px;height:'.$wpflybox_custom4_tab_height.'px" alt="?">';
  }
if (get_option('wpflybox_custom4_URL_instead')==='true'){echo '</a>';}  
?>