<? 
	define('ID_MODULO',25,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'links',
		'tabela'=>'tblinks',
		'titulo'=>'texto',
		'id'=>'id_link',
		'urlfixo'=>'', 
		'pasta'=>'links',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Links</h2>
                    </div>
<div id="conteudo">
<a id="btnalt"  href="links_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar novo link</a>
<br />
<br />
<?

 
	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'LINKS',		'texto',			''),
		array('texto',		'URL',		'url',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM tblinks ORDER BY texto DESC";


	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>