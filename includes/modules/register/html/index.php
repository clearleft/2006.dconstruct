<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="3600" />
<title>Register - d.Construct 2006: Web Application and Web 2.0 Conference</title>
<? include "../includes/meta.php"; ?>
<script type="text/javascript" src="/scripts/countdown.js"></script>
</head>
<body>

<? include "../includes/mainnav.php"; ?>

<? include "../includes/vevent.php"; ?>

<div id="branding"></div><!-- /branding -->

<div id="mainContent">

<h2>Registration &mdash; &pound;75<abbr title="plus Value Added Tax">+VAT</abbr></h2>

<?

if (!include "../includes/countdown.php") {

	include "../includes/modules/register/index.php";

}

?>

</div><!-- /mainContent -->

<div id="secondaryContent">

<? include "../includes/sponsors.php"; ?>

</div><!-- /secondaryContent -->

<? include "../includes/footer.php"; ?>

</body>
</html>