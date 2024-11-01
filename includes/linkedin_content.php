<?php
echo '<div style="display:inline-block;min-height:99px;background-color:'.get_option('wpflybox_linkedin_background').';border:1px solid '.get_option('wpflybox_linkedin_border').';width:364px;">';
echo '<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>';
if (get_option('wpflybox_linkedin_type')=="member")
  {
  echo '<script type="IN/MemberProfile" data-id="'.get_option('wpflybox_linkedin').'" data-format="inline" data-related="false" data-width="364"></script>';
  } else if (get_option('wpflybox_linkedin_type')=="company") 
  {
  echo '<script type="IN/CompanyProfile" data-id="'.get_option('wpflybox_linkedin').'" data-format="inline" data-related="false" data-width="364"></script>';
  }
echo '</div>';
?>