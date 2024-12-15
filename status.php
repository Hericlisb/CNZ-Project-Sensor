<?php

include_once "config.inc.php";

$tempo = filectime(ARQUIVO_SENSORES);
$file = fopen(ARQUIVO_SENSORES, "r");
if($file !== FALSE) {
	echo '<table class="pure-table pure-table-striped">';
	echo "<thead>\n";
	echo "<tr><th>ID</th><th>Pressure (mPa)</th><th>humidity (%)</th><th>Temperature (C)</th></tr>";
	echo "</thead>\n<tbody>\n";
	while(($dados = fgetcsv($file, 0, ";")) !== FALSE) {
		$id = $dados[0];
		$p = $dados[1];
		$um = $dados[2];
		$t = $dados[3];
		echo "<tr><td>$id</td><td>$p</td><td>$um</td><td>$t</td></tr>\n";
	}
	echo "</tbody>\n";
	echo "</table>\n";
	fclose($file);
	if($tempo !== FALSE) {
		echo "<p style=\"font-size: 65%; padding-left: 10px\">Updated in" . date("D d/m Y H:i:s.", $tempo);
	}
}

?>
