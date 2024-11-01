<div style="display:inline-block;border:1px solid <?php echo get_option('wpflybox_googleplus_border'); ?>;width:322px;background-color:<?php echo get_option('wpflybox_googleplus_background'); ?>;">
<?php
echo '<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>';
echo '<div class="g-'.get_option('wpflybox_google_type').'" data-href="'.get_option('wpflybox_google').'" data-layout="'.get_option('wpflybox_google_layout').'" data-showcoverphoto="'.get_option('wpflybox_google_showcover').'" data-showtagline="'.get_option('wpflybox_google_showtag').'" data-theme="'.get_option('wpflybox_google_theme').'" data-width="320"></div>';              
?>
</div> 