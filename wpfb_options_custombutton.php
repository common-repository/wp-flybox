<tr><td style="text-align:right;"><?php echo $wpl_Whichtypebutton; ?></td><td>
<table border="0">
<tr><td style="text-align:center;">
<img src="<?php echo plugins_url()."/wp-flybox/static/"; ?>noncustombuttonexample.png" width="101"><br>
<input type="radio" name="wpflybox_usecustombutton" value="false" <?php if(get_option('wpflybox_usecustombutton')=="false"){echo 'checked';} ?>><br><?php echo $wpl_LogoandText; ?>
</td><td style="text-align:center;">
<img src="<?php echo plugins_url()."/wp-flybox/static/"; ?>custombuttonexample.png" width="101"><br>
<input type="radio" name="wpflybox_usecustombutton" value="true" <?php if(get_option('wpflybox_usecustombutton')=="true"){echo 'checked';} ?>><br><?php echo $wpl_CustomColors; ?>
</td><td><input type="submit" name="Submit" value="<?php echo $wpl_Apply; ?>" />
</td></table>
</td></tr> 
<?php if (get_option('wpflybox_usecustombutton')=="true"){ ?>
<tr><td>
<h4><?php echo $wpl_CustomButtonConfig; ?>:</h4>
</td></tr>
<tr><td style="text-align:right;"><?php echo $wpl_RightGradColor; ?>:</td><td>
<input class="color" type="text" name="wpflybox_bgtopgradient" value="<?php echo get_option('wpflybox_bgtopgradient'); ?>" size="10" />
</td></tr>
<tr><td style="text-align:right;"><?php echo $wpl_LeftGradColor; ?></td><td>
<input class="color" type="text" name="wpflybox_bgbottomgradient" value="<?php echo get_option('wpflybox_bgbottomgradient'); ?>" size="10" />
</td></tr>                   		  
<tr><td style="text-align:right;"><?php echo $wpl_BorderColor; ?>:</td><td>
<input class="color" type="text" name="wpflybox_bgborder" value="<?php echo get_option('wpflybox_bgborder'); ?>" size="10" />
</td></tr>
<?php
$wpflybox_bgtopgradient=get_option('wpflybox_bgtopgradient');
$wpflybox_bgbottomgradient=get_option('wpflybox_bgbottomgradient');
$wpflybox_bgborder=get_option('wpflybox_bgborder');
?>
<tr><td style="text-align:right;"><?php echo $wpl_CurrentTabColors; ?>:<br>&nbsp;<br>&nbsp;</td><td>
<style type="text/css">
.wpflybox_button {
 border-top: 1px solid #<?php echo $wpflybox_bgborder;?>;
 border-right: 1px solid #<?php echo $wpflybox_bgborder;?>;
 border-bottom: 1px solid #<?php echo $wpflybox_bgborder;?>;
 background: #000000;
 background: -webkit-gradient(linear, left top, right top, from(#<?php echo $wpflybox_bgtopgradient;?>), to(#<?php echo $wpflybox_bgbottomgradient;?>));
 background: -webkit-linear-gradient(left, #<?php echo $wpflybox_bgtopgradient;?>, #<?php echo $wpflybox_bgbottomgradient;?>);
 background: -moz-linear-gradient(left, #<?php echo $wpflybox_bgtopgradient;?>, #<?php echo $wpflybox_bgbottomgradient;?>);
 background: -ms-linear-gradient(left, #<?php echo $wpflybox_bgtopgradient;?>, #<?php echo $wpflybox_bgbottomgradient;?>);
 background: -o-linear-gradient(left, #<?php echo $wpflybox_bgtopgradient;?>, #<?php echo $wpflybox_bgbottomgradient;?>);
 filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr='#<?php echo $wpflybox_bgtopgradient;?>', endColorstr='#<?php echo $wpflybox_bgbottomgradient;?>');
 -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr='#<?php echo $wpflybox_bgtopgradient;?>', endColorstr='#<?php echo $wpflybox_bgbottomgradient;?>')";
 display:block;
 height:32px;
 width: 32px;
 margin: 0px;
 padding: 0px;
 -webkit-border-radius: 0px 9px 9px 0px;
 -moz-border-radius: 0px 9px 9px 0px;
 border-radius: 0px 9px 9px 0px;
 color: #ffffff;
 font-size: 10px;
 font-family: Georgia, serif;
 text-decoration: none;
 vertical-align: middle;
 z-index:800;
 }
.wpflybox_button img{
 padding:0px;
 }
 .wpflybox_button img:hover {
 -webkit-border-radius: 0px 9px 9px 0px;
 -moz-border-radius: 0px 9px 9px 0px;
 border-radius: 0px 9px 9px 0px;
 padding:0px;   
 border-bottom:0px hidden;
 background: #000000;
 background: -webkit-gradient(linear, left top, right top, from(#<?php echo $wpflybox_bgtopgradient;?>), to(#<?php echo $wpflybox_bgbottomgradient;?>));
 background: -webkit-linear-gradient(left, #<?php echo $wpflybox_bgtopgradient;?>, #<?php echo $wpflybox_bgbottomgradient;?>);
 background: -moz-linear-gradient(left, #<?php echo $wpflybox_bgtopgradient;?>, #<?php echo $wpflybox_bgbottomgradient;?>);
 background: -ms-linear-gradient(left, #<?php echo $wpflybox_bgtopgradient;?>, #<?php echo $wpflybox_bgbottomgradient;?>);
 background: -o-linear-gradient(left, #<?php echo $wpflybox_bgtopgradient;?>, #<?php echo $wpflybox_bgbottomgradient;?>);
 filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr='#<?php echo $wpflybox_bgtopgradient;?>', endColorstr='#<?php echo $wpflybox_bgbottomgradient;?>');
 -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr='#<?php echo $wpflybox_bgtopgradient;?>', endColorstr='#<?php echo $wpflybox_bgbottomgradient;?>')";
 color: #000000;
 }
</style>
<a class="wpflybox_button" href="#"><img src="<?php echo plugins_url()."/wp-flybox/static/icons/"; ?>facebook.png" height="30"></a>
<br><input type="submit" name="Submit" value="Apply & Refresh" />
</td></tr>
<tr><td colspan="2"><?php echo $wpl_IENoteCorners; ?></td></tr>     		  
<?php
}else{
?> 
<input type="hidden" name="wpflybox_bgtopgradient" value="<?php echo get_option('wpflybox_bgtopgradient'); ?>" />
<input type="hidden" name="wpflybox_bgbottomgradient" value="<?php echo get_option('wpflybox_bgbottomgradient'); ?>" />
<input type="hidden" name="wpflybox_bgborder" value="<?php echo get_option('wpflybox_bgborder'); ?>" />
 <?php
}
?>