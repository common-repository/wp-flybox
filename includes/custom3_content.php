<?php
if (get_option('wpflybox_custom3_URL_instead')==='false'){
echo '<div style="background-color:'.get_option('wpflybox_custom3_background').';border:1px solid '.get_option('wpflybox_custom3_border').';display:inline-block">';
echo do_shortcode(stripslashes(get_option('wpflybox_custom3_content')));
echo '</div>';
}
?>