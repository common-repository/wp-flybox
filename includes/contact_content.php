<?php
$wpflybox_contactencrypted = base64_encode(get_option('wpflybox_contactemail'));
echo '<div style="text-align:center;padding-top:8px;display:inline-block;background-color:'.get_option('wpflybox_contact_background').';border:1px solid '.get_option('wpflybox_contact_border').';display:inline-block;width:360px;"><span id="wpfb_contactMe"><b>'; 
if (get_option('wpflybox_contactwho') == "us"){echo $wpl_Contact_Us;} else {echo $wpl_Contact_Me;} 
?>
<script type="text/javascript">
function wpfb_contact_submit() {
  window.open('<?php echo plugins_url(); ?>/wp-flybox/contact.php', 'popupwindow', 'scrollbars=yes,location=no,menubar=no,width=600,height=400');
  setTimeout(function(){ grecaptcha.reset(); }, 2000);
}
</script>
<?php
echo ':</b></span><br><form style="padding:5px;" action="'.plugins_url().'/wp-flybox/contact.php" method="post" target="popupwindow" onsubmit="wpfb_contact_submit();return true">
  <span id="wpfb_name"><p>'.$wpl_Name.': <input style="padding:1px;" class="enteryourname" name="name" id="name" type="text" /></p></span>
  <span id="wpfb_email"><p>'.$wpl_Email.': <input style="padding:1px;" class="enteryouremail" name="email" id="email" type="text" /></p></span>
  <span id="wpfb_message"><p><textarea rows="2" cols="30" class="enteryourmessage" name="message" id="message">'.$wpl_EnterYourMessage.'</textarea></p></span>';
    if (get_option('wpflybox_captcha')=="true"){ 
    $wpflybox_code= rand(1000,99999);
  echo '<span id="wpfb_captcha"><input value="'.$wpflybox_code.'" name="hiddencode" id="hiddencode" type="hidden" />
  <p><img src="'.plugins_url().'/wp-flybox/static/securityimage/security-image.php?width=200&amp;code='.$wpflybox_code.'" width="200" height="40" alt="Verification Image" /></p>
  <p>'.$wpl_EnterNumberFrom.':<br /><input style="padding:1px;" class="entercaptcha" name ="security_code" id="security_code" type="text" /></p></span>';
     }
     
     if (get_option('wpflybox_recaptcha') == "true") {
         echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
         echo '<div style="padding-bottom:15px;display:inline-block;margin:auto;" class="g-recaptcha" data-sitekey="'.get_option('wpflybox_recaptcha_public').'" >';
         echo '</div>';
         echo '<input type="hidden" name="recaptcha" value="true">';
                                                                
     }
       
  echo '<span id="wpfb_submit"><input value="'.$wpflybox_contactencrypted.'" name="sendtoemail" id="sendtoemail" type="hidden" />      
  <p><input style="padding:2px;" value="'.$wpl_Submit.'" class="submitbutton" type="submit" /></p></span></form></div>';
?>