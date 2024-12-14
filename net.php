<?php

include_once "config.inc.php";

define("LQI_BOM", 100);
define("LQI_MED", 50);

function subtree($node, $nodes, $sinal)
{
	$has_child = FALSE;
	$lqi = $sinal[$node];

	/*
	 * Mostra o nó e a qualidade do sinal.
	 */	
	echo "<li>";
	if($node == 0) echo '<i class="preto fa fa-rss-square"></i>';
	else if($lqi >= LQI_BOM) echo '<i class="azul fa fa-rss-square"></i>';
	else if($lqi >= LQI_MED) echo '<i class="amarelo fa fa-rss-square"></i>';
	else echo '<i class="vermelho fa fa-rss-square"></i>';

	if($node == 0)	echo "&nbsp; Coordenador\n";
	else printf("&nbsp; %02d <span class=\"small\">[$lqi]</span>\n", $node);
	
	/*
	 * Procura nós-filho.
	 */
	for($i=1; $i<MAX_ID; $i++) {
		if($i == $node) continue;
		if(!isset($nodes[$i])) continue;
		if($nodes[$i] == $node) {
			if(!$has_child) {
				$has_child = TRUE;
				echo "\n<ul class=\"rede\">\n";
			}
			subtree($i, $nodes, $sinal);
		}
	}
	
	echo "</li>\n";
	if($has_child) echo "</ul>";
}

/*
 * Abre arquivo CSV.
 */
$file = fopen(ARQUIVO_SENSORES, "r");
if($file !== FALSE) {
	$nodes = array();
	$sinal = array();
	
	/*
	 * Processa arquivo para obter todos os id, next e lqi.
	 */
	while(($dados = fgetcsv($file, 0, ";")) !== FALSE) {
		$id = $dados[0] * 1;
		$next = $dados[4];
		$lqi = $dados[5];
		$nodes[$id] = $next * 1;
		$sinal[$id] = $lqi * 1;
	}
	fclose($file);

	/*
	 * Desenha árvore a partir do nó zero (coordenador).
	 */
	echo "<ul class=\"rede\">\n";
	subtree(0, $nodes, $sinal);
	echo "</ul>\n";	
}

?>
