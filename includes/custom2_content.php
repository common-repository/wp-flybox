<?php
if (get_option('wpflybox_custom2_URL_instead')==='false'){
echo '<div style="background-color:'.get_option('wpflybox_custom2_background').';border:1px solid '.get_option('wpflybox_custom2_border').';display:inline-block">';
echo do_shortcode(stripslashes(get_option('wpflybox_custom2_content')));
echo '</div>';
}
?>