<?php
echo '<div style="background-color:'.get_option('wpflybox_subscription_background').';border:1px solid '.get_option('wpflybox_subscription_border').';min-height:99px;text-align:center;display:inline-block">      
<div style="color:#F66303;margin:10px 10px 5px 10px;width:270px;font-size:14px;text-align:center;background-color:#ffffff;">
'.$wpl_SubscribetoReceive.':
</div>
<form action="//feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri='.get_option('wpflybox_feedburner').'\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return true">
<input style="padding:2px;" class="enteryouremail" name="email" value="'.$wpl_enteremailhere.'" onblur="if (this.value == &#39;&#39;) {this.value = &#39;'.$wpl_enteremailhere.'&#39;;}" onfocus="if (this.value == &#39;'.$wpl_enteremailhere.'&#39;) {this.value = &#39;&#39;;}" type="text" />
<input value="'.get_option('wpflybox_feedburner').'" name="uri" type="hidden" />
<input style="padding:2px;" value="'.$wpl_Submit.'" class="submitbutton" type="submit" />
</form>
</div>';
?>