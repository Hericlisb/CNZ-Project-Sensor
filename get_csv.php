<?php 
include_once("config.inc.php");

/*
 * Obtém estampas Unix das datas fornecidas.
 */
$inicio = date_create_from_format("d/m/Y G:i", $_POST["inicio"]);
$fim = date_create_from_format("d/m/Y G:i", $_POST["fim"]);

if(($inicio === FALSE) || ($fim === FALSE)) redirect_to_error();

$s_inicio = date_timestamp_get($inicio);
$s_fim = date_timestamp_get($fim);

/*
 * Find file.
 */
$filename = $_POST["addr"] . ".csv";
$filepath = LOG_DIR . "/" . $filename;
$file = fopen($filepath, "r");
if($file === FALSE) redirect_to_no_data();

/*
 * Finds start time.
 */
while(($dados = fgetcsv($file, 0, ";")) !== FALSE) {
	if(1*$dados[1] >= $s_inicio) break;
}
if($dados === FALSE) redirect_to_no_data();

/*
 * Starts file transmission.
 */
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$filename}");
header("Expires: 0");
header("Pragma: public");

$fh = @fopen( 'php://output', 'w' );
fputcsv($fh, $dados, ";");

/*
 * Scans data up to the specified limit.
 */
while(($dados = fgetcsv($file, 0, ";")) !== FALSE) {
	if(1*$dados[1] > $s_fim) break;
	fputcsv($fh, $dados, ";");
}

fclose($fh);
exit;

function redirect_to_error()
{
	echo "<script type=\"text/javascript\">
   	      alert(\"Invalid date format");
      	   history.back();
      	</script>";	
	exit;
}

function redirect_to_no_data()
{
	echo "<script type=\"text/javascript\">
   	      alert(\"There is no data in the selected period\");
      	   history.back();
      	</script>";	
		exit;
}

?>