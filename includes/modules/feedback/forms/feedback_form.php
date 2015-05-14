<?


$output = "";

$output.= "<form method=\"post\" action=\"";
$output.= $_SERVER['PHP_SELF'];
$output.= "\" id=\"feedbackform\">\n";

$fields = array(
	"name"		=>	array(
		"name"	=>	"name",
		"label"	=>	"Your name",
		"type"	=>	"text"),
	"email"		=>	array(
		"name"	=>	"email",
		"label"	=>	"Your email",
		"type"	=>	"text"),
	"message"		=>	array(
		"name"	=>	"message",
		"label"	=>	"Your message",
		"type"	=>	"textarea")
);

$output.= displayFieldset("Your details",$fields,$_REQUEST,$errors);

$output.= "<p><input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Submit\" /></p>\n";
$output.= "</form>\n";

return $output;

?>