<?php 
if (!@mysql_connect('localhost','clagnut','Kathhuv7')) {
	die(mysql_error());
}
if (!@mysql_select_db('dconstruct')) {
	die(mysql_error());
}

$people = ceil($_GET['amt']/88.13);

$query = "
INSERT
INTO
registration
(people,amount)
VALUES
(
".$people.",
'".$_GET['amt']."'
)
";

mysql_query($query) or die(mysql_error());

header("Location: /register/thanks.php");

?>