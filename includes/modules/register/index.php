<?

$signups = 0;
$allocation = 285;

if (!@mysql_connect('localhost','clagnut','Kathhuv7')) {
	die(mysql_error());
}
if (!@mysql_select_db('dconstruct')) {
	die(mysql_error());
}

$query = "SELECT people FROM registration";

$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {

	$signups+= $row['people'];

}

echo "<!-- signups: $signups -->\n";

mysql_free_result($result);

if ($signups < $allocation) {

	include "forms/register_form.php";

} else {

	include "html/register_full.php";

}
?>