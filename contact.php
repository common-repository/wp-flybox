<?php
require_once( '../../../wp-load.php' );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
</head>
<body>
<?php
function previous_request_value($str)
{
if (isset($_REQUEST[$str]) )
return $_REQUEST[$str];
else
return '';
}
function cndstrips($str)
{
if (get_magic_quotes_gpc())
return stripslashes($str);
else
return $str;
}
$contact_to_email=previous_request_value('sendtoemail');
$contact_to_email = base64_decode($contact_to_email);
$visitor_email=cndstrips(trim(previous_request_value('email')));
$visitor_name=cndstrips(trim(previous_request_value('name')));
$message_body=cndstrips(previous_request_value('message'));
$numcode=cndstrips(previous_request_value('security_code'));
$hiddencode=cndstrips(previous_request_value('hiddencode'));
$recaptcha=cndstrips(trim(previous_request_value('recaptcha')));
if(isset($_POST['g-recaptcha-response'])){
          $recap_response=$_POST['g-recaptcha-response'];
          //echo $recap_response;
        }
$message_subject="Contact Form Submitted";
$security_code=str_replace(' ','',cndstrips(trim(previous_request_value('security_code'))));
$errors="";
$message_sent=false;
function wp_validate_email($email) {
return preg_match('/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]+\.[A-Za-z0-9_\-\.]+$/', $email) == 0;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (wp_validate_email($visitor_email) ) {
$errors.="Please enter a valid email address in the form of user@place.ext<br/><br/>";
}
$newcode = (54213+$hiddencode)*2;
if ((substr($numcode, 0, 5) !== substr($newcode, 0, 5)) && ($hiddencode)) {
$errors.="The verification code for the image presented was incorrect. Please enter a correct verification code.<br/><br/>";
}
if ($message_body == '')
$errors.="Please enter a message<br/><br/>";
if ($visitor_name == '')
$errors.="Please enter your name<br/><br/>";

if ($recaptcha == "true") {
        require_once( '../../../wp-load.php' );
        $secretKey = get_option('wpflybox_recaptcha_private');
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$recap_response."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        
        //var_dump($responseKeys);
        if (!$responseKeys["success"]) {
        $errors.="Incorrect Recaptcha, please try again<br /><br />";
        }
}
if ( !$errors ) {
$ip = $_SERVER["REMOTE_ADDR"];
$httpagent = $_SERVER["HTTP_USER_AGENT"];
$time = date("D, F j, Y H:i O");
if ($visitor_name)
$visitor_name_and_email="$visitor_name <$visitor_email>";
else
$visitor_name_and_email="$visitor_email";
if ($contact_from_name)
$contact_from_email="$contact_from_name <$contact_from_email>";
$message = "
$message_body
____________________________
Browser Info: $ip $httpagent
";
mail($contact_to_email,$message_subject, $message, "From: $visitor_name_and_email");
echo "Your message";
echo "<div style='border: 1px solid black; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>From: ".htmlentities($visitor_name_and_email)."<br />Subject: ".htmlentities($message_subject)."<br />".htmlentities($message_body)."</div>";
echo "Has been sent. Thank you for contacting us.<br><br><br><br><br><br><br><br><br><br><br><br>";
$message_sent=true;
}
}
//if (!$message_sent) {
//$this_file = substr(strrchr($_SERVER['PHP_SELF'], "/"), 1);
if ($errors) {
echo "<br />";
echo "<span style='color:red'><br />$errors</span>";
}
?>
</body>
</html>