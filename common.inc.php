
<?php
include_once 'config.inc.php';

function get_menu($selected) 
{
	$str = "";
	$href = "online.php";
	if($selected === 0) $str = " pure-button-primary";
	echo "<a class=\"pure-button$str\" href=\"$href\">";
	echo "<i class=\"fa fa-refresh\"></i><br>Online</a>\n";
	
	$str = "";
	$href = "network.php";
	if($selected === 1) $str = " pure-button-primary";
	echo "<a class=\"pure-button$str\" href=\"$href\">";
	echo "<i class=\"fa fa-cubes\"></i><br>Network</a>\n";

	
	$str = "";
	$href = "datalog.php";
	if($selected === 2) $str = " pure-button-primary";
	echo "<a class=\"pure-button$str\" href=\"$href\">";
	echo "<i class=\"fa fa-file-text\"></i><br>Datalogger</a>\n";
}

function get_html_header()
{
	echo <<<EOF
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="local.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="jquery.timer.js"></script>
EOF;

} 

function get_addr_combo()
{
	echo "<select>\n";
	$dir = opendir(LOG_DIR);
	if($dir) {
		while(false !== ($item = readdir($dir))) {
			if($item === ".") continue;
			if($item === "..") continue;
			if(!preg_match('/([0-9]+)\.csv/', $item, $result)) continue;
			$id = $result[1];
			echo "<option value=\"$id\">$id</option>\n";
		}
	}
	echo "</select>\n";
}

function get_download_table()
{
   echo '<table class="pure-table pure-table-horizontal">';
   echo "<thead>\n";
   echo "<tr><th>ID</th><th>Início</th><th>Fim</th><th>Download</th></tr>";
   echo "</thead>\n<tbody>\n";

   $dir = opendir(LOG_DIR);
	if($dir) {
		while(false !== ($item = readdir($dir))) {
			if($item === ".") continue;
			if($item === "..") continue;
			if(!preg_match('/([0-9]+)\.csv/', $item, $result)) continue;
			$id = $result[1];
			echo "<tr><td>$id</td>";
			echo "<td><input id=\"i_$id\" type=\"text\" class=\"date_time\"></td>";
			echo "<td><input id=\"f_$id\" type=\"text\" class=\"date_time\"></td>";
			echo "<td><i id=\"b_$id\" class=\"b_ fa fa-file-excel-o\"</i></td></tr>\n";
		}
	}
	echo "</tbody></table>\n";
}
?>
