<?php 
$floodgates = strtotime("September 8, 2006 9:00 BST");

$now = time();

if ($floodgates < $now ) {

	return false;

}

$diff = $floodgates - $now;
$time = array();

/*
$time["year"] = floor($diff/60/60/24/7/365);
$diff -= $time["year"]*60*60*24*365;
$time["month"] = floor($diff/60/60/24/30);
$diff -= $time["month"]*60*60*24*30;
$time["week"] = floor($diff/60/60/24/7);
$diff -= $time["week"]*60*60*24*7;
*/

$time["day"] = floor($diff/60/60/24);
$diff -= $time["day"]*60*60*24;
$time["hour"] = floor($diff/60/60);
$diff -= $time["hour"]*60*60;
$time["minute"] = floor($diff/60);
$diff -= $time["minute"]*60;
$time["second"] = $diff;


$tbody = "<tr>\n";
$thead = "<tr>\n";


foreach ($time as $key => $value) {

	$tbody.= "<td id=\"";
	$tbody.= $key;
	$tbody.= "s\">";
	$tbody.= sprintf("%02d",$value);
	if ($key != "second") {
		$tbody.= ":";
	}
	$tbody.= "</td>\n";

	$thead.= "<th>";
	$thead.= ucwords($key);
	if ($value > 1) {
		$thead.= "s";
	}
	$thead.= "</th>\n";

}
$tbody.= "</tr>\n";
$thead.= "</tr>\n";

echo "<div id=\"countdown\">\n";
echo "<table summary=\"Countdown to the conference\">\n";
echo $tbody;
echo $thead;
echo "</table>\n";
echo "</div>\n";

?>