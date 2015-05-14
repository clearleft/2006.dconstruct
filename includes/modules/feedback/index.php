<?

$return = "";

$return.= "<div id=\"feedbackcanvas\">\n";

$criteria = array(
	"email"		=> array("required","email"),
	"name"		=> array("required"),
	"message"	=> array("required")
);

if (isset($_REQUEST["submit"])) {

	require_once("functions/checkInput.php");

	$errors = checkInput($_REQUEST,$criteria);

	if (count($errors) < 1) {

		require_once("functions/akismet.php");

		$akismet_data = array(
		
			'blog'					=>	"http://2006/dconstruct.org/",
			'user_ip'				=>	$_SERVER['REMOTE_ADDR'],
			'user_agent'			=>	$_SERVER['HTTP_USER_AGENT'],
			'referrer'				=>	$_SERVER['HTTP_REFERER'],
			'comment_author'		=>	$_REQUEST["name"],
			'comment_author_email'	=>	$_REQUEST["email"],
			'comment_content'		=>	$_REQUEST["message"]
		
		);

		$akismet_result = akismet("4e7cbc443451","/1.1/comment-check",$akismet_data);

		if ($akismet_result[1] != "true") {

			$return.= include "actions/feedback_submit.php";

		}

	} else {

		require_once("functions/displayFieldset.php");
		$return.= include "forms/feedback_form.php";

	}

} else {

	$errors = array();
	require_once("functions/displayFieldset.php");
	$return.= include "forms/feedback_form.php";

}

$return.= "</div><!-- /#feedbackcanvas -->\n";

echo $return;

?>