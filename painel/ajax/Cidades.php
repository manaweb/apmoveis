<?
	header('Content-Type: text/xml');
	include ('../includes/BancoDeDados.php'); 
	include ('../includes/Funcoes.php'); 
	include ('../includes/Config.php'); 
	include ('../includes/Imagens.php'); 
	include ('../includes/Validacoes.php'); 


	echo '<?xml version="1.0" encoding="iso-8859-1"?>'."\n";
	echo '<lista>'."\n";



	$consulta=db_consulta("SELECT * FROM tbcidades WHERE id_estado=".(int)$_GET['id_estado']." ORDER BY nome_cidade ASC");
	while ($linha = db_lista($consulta)) {
		echo '<campo codigo="'.$linha['id_cidade'].'" valor="'.($linha['nome_cidade']).'" />'."\n";;
	}



	echo '</lista>'."\n";
?>