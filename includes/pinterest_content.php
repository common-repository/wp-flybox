<?php
echo '<div style="align:center;width:255px;min-height:99px;border:1px solid '.get_option('wpflybox_pinterest_border').';display:inline-block;background-color:'.get_option('wpflybox_pinterest_background').';">
<a href="http://pinterest.com/'.get_option('wpflybox_pinterest').'" target="_blank">
<img src="'.plugins_url().'/wp-flybox/static/pinterest-button.png" alt="pinterest button" title="Pinterest" width="250" height="60" style="border:none;';
if (get_option('wpflybox_usecustombutton') == "false")
  {
  echo ' margin-top:14px;';
  }
echo '" />
</a>
</div>';
?>