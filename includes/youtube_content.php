<?php
echo '<div style="background-color:'.get_option('wpflybox_youtube_background').'; overflow:hidden; width:300px; height:99px;border:1px solid '.get_option('wpflybox_youtube_border').';display:inline-block;">';
if (get_option('wpflybox_youtube') == '') {
  echo '<script src="https://apis.google.com/js/platform.js"></script><div style="padding-top:10px;padding-left:10px;"><div class="g-ytsubscribe" data-channelid="'.get_option('wpflybox_youtube_channel').'" data-layout="full" data-count="default"></div></div></div>';
} else {
echo '<iframe src="https://www.youtube.com/subscribe_widget?p='.get_option('wpflybox_youtube').'" style="height: 99px; width: 300px; border:none; overflow:hidden; background-color:'.get_option('wpflybox_youtube_background').'"></iframe>
</div>';
}
?>