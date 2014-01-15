<?php
	include("../../../php/config/config.php");
	include("../includes/Config.php");
	$imagem = $_GET['imagem'];
	$campo = $_GET['campo'];
	$id = $_GET['id'];
	@unlink("../../arquivos/produtos/".$imagem);
	@unlink("../../arquivos/produtos/_miniaturas/".$imagem);
	if(mysql_query("update tbprodutos set $campo = '' where id = $id")){
		echo "true";
	}else{
		echo "false";
	}

?>