<div id="mainNav">
<ul>
<?
echo "<li";
if ($_SERVER['PHP_SELF'] == "/index.php") {
	echo " class=\"currentPage\">Home";
} else {
	echo "><a href=\"/\" accesskey=\"1\">Home</a>";
}
echo "</li>\n";

$sections = array("speakers", "schedule", "podcast");

$accesskeys = array(
	"contact"	=>	"9"
);

foreach ($sections as $section) {

	echo "<li";
	if (stristr($_SERVER['PHP_SELF'],$section)) {
		echo " class=\"currentPage\"";
	}
	echo ">";
	if (!stristr($_SERVER['PHP_SELF'],$section)) {
		echo "<a href=\"/";
		echo $section;
		echo "\"";
		if (isset($accesskeys[$section])) {
			echo " accesskey=\"";
			echo $accesskeys[$section];
			echo "\"";
		}
		echo ">";
	}
	echo ucwords($section);
	if (!stristr($_SERVER['PHP_SELF'],$section)) {
		echo "</a>";
	}
	echo "</li>\n";

}

?>
</ul>
</div>