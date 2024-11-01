<?php
//echo '<div style="overflow:hidden;">';
if (get_option('wpflybox_flickr_type')=='flash')
  {
  echo '<div style="background-color:'.get_option('wpflybox_flickr_background').'; overflow:hidden; width:113px; height:151px; overflow:hidden;border:1px solid '.get_option('wpflybox_flickr_border').';display:inline-block;">';
  echo '<iframe scrollbars="no" style="background-color:'.get_option('wpflybox_flickr_background').'; border:none; width:113px; height:151px; overflow:hidden;" src="http://www.flickr.com/apps/badge/badge_iframe.gne?zg_bg_color='.str_replace("#","",get_option('wpflybox_flickr_background')).'&amp;zg_person_id='.get_option('wpflybox_flickr').'&amp;zg_tags='.get_option('wpflybox_flickr_tag').'&amp;zg_tag_mode=any" title="Flickr Badge"></iframe>';
  }else{
  echo '<div style="background-color:'.get_option('wpflybox_flickr_background').'; overflow:hidden; width:238px; height:238px; overflow:hidden;border:1px solid '.get_option('wpflybox_flickr_border').';display:inline-block;">';
  echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?
    count=9&size=s&display=latest&source=user&user='.get_option('wpflybox_flickr');
    if (get_option('wpflybox_flickr_tag')!==''){echo '&source=all_tag&tag='.get_option('wpflybox_flickr_tag');}
    echo '"></script>';  
  }
echo '</div>';
?>