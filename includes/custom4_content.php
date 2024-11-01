<?php
if (get_option('wpflybox_custom4_URL_instead')==='false'){
echo '<div style="background-color:'.get_option('wpflybox_custom4_background').';border:1px solid '.get_option('wpflybox_custom4_border').';display:inline-block">';
echo do_shortcode(stripslashes(get_option('wpflybox_custom4_content')));
echo '</div>';
}
?>