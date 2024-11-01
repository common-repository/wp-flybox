<?php
if (!class_exists('Mobile_Detect', false))
  {
  require_once 'includes/Mobile_Detect.php';
  }
$detect = new Mobile_Detect;
if ((get_option('wpflybox_mobile')=='true' && $detect->isMobile() && !$detect->isTablet()) || (get_option('wpflybox_tablet')=='true' && $detect->isTablet()) || !$detect->isMobile())
{
$click_or_hover=get_option('wpflybox_hoverorclick');
$number_of_tabs=get_option('wpflybox_count');
$right_or_left=get_option('wpflybox_side');
if ($right_or_left=='left'){$opposite_right_or_left='right';}else{$opposite_right_or_left='left';}

if (get_option('wpflybox_enque_jquery') == 'true')
  {
  wp_enqueue_script( 'jQuery' );
  } 
           
if (get_option('wpflybox_usecustombutton') == "true")
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
   filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr=\'#'.$wpflybox_bgtopgradient.'\', endColorstr=\'#'.$wpflybox_bgbottomgradient.'\')";
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
   filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr=\'#'.$wpflybox_bgtopgradient.'\', endColorstr=\'#'.$wpflybox_bgbottomgradient.'\')";
   -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr=\'#'.$wpflybox_bgtopgradient.'\', endColorstr=\'#'.$wpflybox_bgbottomgradient.'\')";   
   color: #000000;
   }';
  echo '</style>';
  }
?>
<script type="text/javascript">
<?php
$i=1;
while ($i<=$number_of_tabs)
  {
  ?>
  var tab<?php echo $i; ?>_pos=0;
  var wpfb<?php echo $i; ?>_tab_width;
  <?php
  $i++;
  }
?>
jQuery(window).load(function(){
<?php
$i=1;
$tab_width=array();
//move tabs to edge
while($i<=$number_of_tabs)
  {
  if (get_option('wpflybox_my_'.get_option('wpflybox_tab'.$i).'_tab') !='')
    {
    $tab_width[$i]=intval(get_option('wpflybox_my_'.get_option('wpflybox_tab'.$i).'_tab_width'));
    }else {
     $tab_width[$i]=32;
    }
  ?>
  var tab_width=<?php echo $tab_width[$i]; ?>;
  wpfb<?php echo $i; ?>_tab_width=<?php echo $tab_width[$i]; ?>;
  if (jQuery("#wp-flybox_tab<?php echo $i; ?>").length > 0 && tab<?php echo $i; ?>_pos==0) 
    {
    var i_width=jQuery("#wp-flybox_tab<?php echo $i; ?>").width()-tab_width;
    i_width='-'+i_width+'px';
    document.getElementById('wp-flybox_tab<?php echo $i; ?>').style.<?php echo $right_or_left; ?>=i_width;
    }
  <?php
  $i++;
  }
if (get_option('wpflybox_scrollingfix')=='true')
  {  
?>
var canvasHeight=jQuery("#wp-flybox_tab<?php echo $number_of_tabs; ?>").position().top+jQuery("#wp-flybox_tab<?php echo $number_of_tabs; ?>").height();
jQuery('#wpflybox_container').height(canvasHeight);
<?php } ?>
});

jQuery(document).ready(function(){
var doc_height=jQuery(document).height()
var scrollTooMuch=parseInt('<?php echo get_option('wpflybox_scollingfix_toomuch'); ?>');
if (scrollTooMuch===NaN || scrollTooMuch==''){scrollTooMuch=0;}
jQuery('#wpflybox_container').height(doc_height-scrollTooMuch);
<?php
$i=1;
$tab_width=array();
//move tabs to edge
while($i<=$number_of_tabs)
  {
  if (get_option('wpflybox_my_'.get_option('wpflybox_tab'.$i).'_tab') !='')
    {
    $tab_width[$i]=intval(get_option('wpflybox_my_'.get_option('wpflybox_tab'.$i).'_tab_width'));
    }else {
     $tab_width[$i]=32;
    }
  ?>
  var tab_width=<?php echo $tab_width[$i]; ?>;
  if (jQuery("#wp-flybox_tab<?php echo $i; ?>").length > 0) 
    {
    var i_width=jQuery("#wp-flybox_tab<?php echo $i; ?>").width()-tab_width;
    i_width='-'+i_width+'px';
    document.getElementById('wp-flybox_tab<?php echo $i; ?>').style.<?php echo $right_or_left; ?>=i_width;
    }
  <?php
  $i++;
  }
//click/hover jquery function

$i=1;
if ($click_or_hover=='click')
{
while ($i<=$number_of_tabs)
  {
  ?>
  jQuery("#wp-flybox_tab<?php echo $i; ?> div.wp_but").click(function(){
  <?php
  //get tab
  $tabname=get_option('wpflybox_tab'.$i);
  $closedimg=get_option('wpflybox_my_'.$tabname.'_tab');
  $openedimg=get_option('wpflybox_my_'.$tabname.'_tab_open');
  $customjs=get_option('wpflybox_'.$tabname.'_onclick_js');
  ?>  
    if(tab<?php echo $i; ?>_pos==0)
      {
      jQuery("#wp-flybox_tab<?php echo $i; ?>").animate({<?php echo $right_or_left; ?>:'0px'});
      <?php
      if ($openedimg !='')
        {
        ?>
        document.getElementById("wpfb_tab_img<?php echo $i; ?>").src = "<?php echo $openedimg; ?>";
        <?php
        }
      $j=1;
      while ($j<=$number_of_tabs)
        {
        if ($j!=$i)
          {
          ?>
          var tab_width=<?php echo $tab_width[$j]; ?>;
          var wpfb<?php echo $i; ?>_tab_width=<?php echo $tab_width[$i]; ?>;
          var j_width=jQuery("#wp-flybox_tab<?php echo $j; ?>").width()-tab_width;
          j_width='-'+j_width;
          jQuery("#wp-flybox_tab<?php echo $j; ?>").animate({<?php echo $right_or_left; ?>:j_width});
          <?php
          }
        $j++;
        }
      $j=1;
      while ($j<=$number_of_tabs)
        {
        ?>
        tab<?php echo $j; ?>_pos=0;
        <?php
        $j++;
        }
        ?>
      tab<?php echo $i; ?>_pos=1;
      <?php echo stripslashes($customjs); ?>
      } else {  
      var tab_width=<?php echo $tab_width[$i]; ?>;   
      var i_width=jQuery("#wp-flybox_tab<?php echo $i; ?>").width()-tab_width;
      i_width='-'+i_width;
      jQuery("#wp-flybox_tab<?php echo $i; ?>").animate({<?php echo $right_or_left; ?>:i_width});
      <?php
      if ($openedimg !='')
        {
        ?>
        document.getElementById("wpfb_tab_img<?php echo $i; ?>").src = "<?php echo $closedimg; ?>";
        <?php
        }
      ?>       
      tab<?php echo $i; ?>_pos=0;
      }
  });
  <?php
  $i++;
  }
} else {
while ($i<=$number_of_tabs)
  {
  $tabname=get_option('wpflybox_tab'.$i);
  $customjs=get_option('wpflybox_'.$tabname.'_onclick_js');
  ?>
  jQuery("#wp-flybox_tab<?php echo $i; ?>").hover(function(){
    if(tab<?php echo $i; ?>_pos==0)
      {
      jQuery("#wp-flybox_tab<?php echo $i; ?>").animate({<?php echo $right_or_left; ?>:'0px'});
      <?php
      $j=1;
      while ($j<=$number_of_tabs)
        {
        if ($j!=$i)
          {
          ?>
          var tab_width=<?php echo $tab_width[$j]; ?>;
          var j_width=jQuery("#wp-flybox_tab<?php echo $j; ?>").width()-tab_width;
          j_width='-'+j_width;
          jQuery("#wp-flybox_tab<?php echo $j; ?>").animate({<?php echo $right_or_left; ?>:j_width});
          <?php
          }
        $j++;
        }
      $j=1;
      while ($j<=$number_of_tabs)
        {
        ?>
        tab<?php echo $j; ?>_pos=0;
        //console.log("tab<?php echo $j; ?>_pos=0");
        <?php
        $j++;
        }
        ?>
      tab<?php echo $i; ?>_pos=1;
      <?php echo stripslashes($customjs); ?>
      //console.log("tab<?php echo $i; ?>_pos=1");
      //console.log(" ");
      } else {
      var tab_width=<?php echo $tab_width[$i]; ?>;
      var i_width=jQuery("#wp-flybox_tab<?php echo $i; ?> div.wp_but").width()-tab_width;
      i_width='-'+i_width;
      jQuery("#wp-flybox_tab<?php echo $i; ?>").animate({<?php echo $right_or_left; ?>:i_width});
      tab<?php echo $i; ?>_pos=0;
      }
  },function(){
   //jQuery("#wp-flybox_tab<?php echo $i; ?>").mouseleave(function(){
    var tab_width=<?php echo $tab_width[$i]; ?>;
    if (jQuery("#wp-flybox_tab<?php echo $i; ?>").length > 0) 
      {
      var i_width=jQuery("#wp-flybox_tab<?php echo $i; ?>").width()-tab_width;
      i_width='-'+i_width+'px';
      jQuery("#wp-flybox_tab<?php echo $i; ?>").animate({<?php echo $right_or_left; ?>:i_width});
      } 
    //}); 
  });
  <?php
  $i++;
  }
}
?>

});
//get cookie and set cookie
<?php
if(!isset($_COOKIE['wp-flybox-seen'])) {
    $wpfbcookie=0;
} else {
    $wpfbcookie=$_COOKIE['wp-flybox-seen'];
}

?>
//write cookie
var d = new Date();
    d.setTime(d.getTime() + (30*24*60*60*1000));
    var expires = d.toUTCString();
document.cookie = 'wp-flybox-seen=1; expires='+expires+'; path=/';
 
//auto out
jQuery(window).load(function(){
<?php
$i=1;
$wpflybox_tab_auto_out=Array();
while ($i<=$number_of_tabs)
  {
  $wpflybox_tab_auto_out[$i]=get_option('wpflybox_tab'.$i.'_auto_out');
  $wpflybox_tab_auto_out_cookie[$i]=get_option('wpflybox_tab'.$i.'_auto_out_cookie');
  $wpflybox_tab_auto_out_homeonly[$i]=get_option('wpflybox_tab'.$i.'_auto_out_onlyhome');
  if ($wpflybox_tab_auto_out[$i]>0 && (($wpflybox_tab_auto_out_homeonly[$i]==1 && (is_home() || is_front_page())) || $wpflybox_tab_auto_out_homeonly[$i]==0) && ($wpflybox_tab_auto_out_cookie[$i]==0 || ($wpfbcookie!=1 && $wpflybox_tab_auto_out_cookie[$i]==1)))
    {
    ?>
    jQuery("#wp-flybox_tab<?php echo $i; ?>").animate({<?php echo $right_or_left; ?>:'0px'});
    tab<?php echo $i; ?>_pos=1;
    <?php
    if ($wpflybox_tab_auto_out[$i]<1801)
      {
      ?>
      setTimeout(function()
      	{ 
      	var j_width=jQuery("#wp-flybox_tab<?php echo $i; ?>").width()-wpfb<?php echo $i; ?>_tab_width;
        j_width='-'+j_width;
        jQuery("#wp-flybox_tab<?php echo $i; ?>").animate({<?php echo $right_or_left; ?>:j_width});
      	tab<?php echo $i; ?>_pos=0; 
      	}, <?php echo $wpflybox_tab_auto_out[$i]*1000; ?>);
        
      <?php      
      }    
    }
  $i++;
  }
?>  
});

//resize
var resizeTimer;
jQuery(window).on('resize', function(e) {

  clearTimeout(resizeTimer);
  resizeTimer = setTimeout(function() {
    <?php
    $i=1;
    //move tabs to edge
    while($i<=$number_of_tabs)
      {
      ?>
      var tab_width=<?php echo $tab_width[$i]; ?>;
      if (jQuery("#wp-flybox_tab<?php echo $i; ?>").length > 0) 
        {
        var i_width=jQuery("#wp-flybox_tab<?php echo $i; ?>").width()-tab_width;
        i_width='-'+i_width+'px';
        document.getElementById('wp-flybox_tab<?php echo $i; ?>').style.<?php echo $right_or_left; ?>=i_width;    
        }
      <?php
      $i++;
      }
      
      if (get_option('wpflybox_scrollingfix')=='true')
        {  
        ?>
        var canvasHeight=jQuery("#wp-flybox_tab<?php echo $number_of_tabs; ?>").position().top+jQuery("#wp-flybox_tab<?php echo $number_of_tabs; ?>").height();
        jQuery('#wpflybox_container').height(canvasHeight);
        <?php }
      ?>
            
  }, 350);

});

//resize
/*
var resizeId;
jQuery(window).resize(function() {
    clearTimeout(resizeId);
    resizeId = setTimeout(doneResizing, 500);
});
 
 
function doneResizing(){
    var scrollTooMuch=parseInt('<?php echo get_option('wpflybox_scollingfix_toomuch'); ?>');
    if (scrollTooMuch===NaN){scrollTooMuch=0;}
    jQuery('#wpflybox_container').height(0);
    document.getElementById("wpflybox_container").style.height ='0px';
    var doc_height=jQuery(document).height()
    jQuery('#wpflybox_container').height(doc_height-scrollTooMuch); 
}
*/
</script>
<?php
}
?>