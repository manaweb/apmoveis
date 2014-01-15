<?php
	include("php/config/config.php");
	include("painel/includes/BancoDeDados.php");
	$conexao = db_conectar();
	$lastId = $_GET['lastId'];
	$limite = "limit 0,6";
	$catid = $_GET['catid'];
	$id = $_GET['id'];
	$pesquisa = $_GET['pesquisa'];
	$promocoes = $_GET['promocoes'];
	if (isset($promocoes) && $promocoes == 1)
		$promocoes = "and emOferta = 1";
	else
		$promocoes = '';
	if (isset($id)) {
		$consulta = "SELECT id, nome, foto1, emOferta FROM tbprodutos WHERE id < $lastId and id_subcategoria = '$id' $promocoes $limite";
		$query = mysql_query($consulta);
	}else if (isset($catid)) {
		$consulta = "SELECT tbprodutos.id, tbprodutos.nome, tbprodutos.foto1, tbprodutos.emOferta FROM tbprodutos INNER JOIN tbprodutos_subcategorias ON tbprodutos.id_subcategoria = tbprodutos_subcategorias.id_subcategoria WHERE id < $lastId and tbprodutos_subcategorias.categoria = '$catid' $promocoes $limite";
		$query = mysql_query($consulta);
	}else if(isset($pesquisa)){
		$consulta = "SELECT id, nome, foto1, emOferta FROM tbprodutos where id < $lastId and upper(nome) like upper('%$pesquisa%') or upper(descricao) like upper('%$pesquisa%') $limite";
		$query = mysql_query($consulta);
	}else {
		$consulta = "SELECT id, nome, foto1, emOferta FROM tbprodutos where id < $lastId $promocoes $limite";
		$query = mysql_query($consulta);
	}
	$html = "";
	while ($dados = mysql_fetch_assoc($query)) {
		$oferta = '';
		if ($dados['emOferta'] > 0)
			$oferta = "<img class='img-responsive pull-right ofertas' src='./img/oferta.png' alt=''>";
		$html.="<div id=".$dados['id']." class='loja-produto-box img-thumbnail col-lg-3 col-md-3 col-sm-3 col-xs-10 produtinho'>
				  $oferta
		          <img class='img-responsive' src='painel/arquivos/produtos/_miniaturas/".$dados['foto1']."' alt=''>
		          <p>
		            <b>".utf8_encode($dados['nome'])."</b>
		          </p>
		          <a href='ver_produtos.php?id=".$dados['id']."'><img class='img-responsive orca' src='./img/btn-orca.png' alt=''></a>
				</div>";
	}
	echo $html;

?>