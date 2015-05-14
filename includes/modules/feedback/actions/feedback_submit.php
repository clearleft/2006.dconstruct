<?php 
$output = "";

if (!empty($_REQUEST["email"]) && stristr($_REQUEST["email"]," ")) {
	$_REQUEST["email"] = substr($_REQUEST["email"],0,strpos($_REQUEST["email"]," "));
}
if (!empty($_REQUEST["message"]) && stristr($_REQUEST["message"],"Content-Type:")) {
	$_REQUEST["message"] = substr($_REQUEST["message"],0,strpos($_REQUEST["message"],"Content-Type:"));
}
if (!empty($_REQUEST["name"]) && stristr($_REQUEST["name"],"Content-Type:")) {
	$_REQUEST["name"] = substr($_REQUEST["name"],0,strpos($_REQUEST["name"],"Content-Type:"));
}

$recipients = array(
"jeremy@clearleft.com",
"andy@clearleft.com",
"richard@clearleft.com"
);

$subject = "d.Construct message";

if (!empty($_REQUEST["name"])) $subject.= " from ".$_REQUEST["name"];

foreach ($recipients as $recipient) {

	mail($recipient,$subject,stripslashes($_REQUEST["message"]),"FROM: ".$_REQUEST["email"]);

}

$output.= "<p class=\"feedback\">";
$output.= "Thank you for getting in touch.";
$output.= "</p>\n";

return $output;

?>