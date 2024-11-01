<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

include ('defaults.php');

foreach ($wpfb_defaults as $key => $value)
  {
    delete_option($key);
  }

?>