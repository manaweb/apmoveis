<? 
	define('ID_MODULO',63,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'lideranca',
		'tabela'=>'tblideranca',
		'titulo'=>'titulo',
		'id'=>'id_lideranca',
		'urlfixo'=>'', 
		'pasta'=>'lideranca',
	);

?>
<?
include('../includes/Mensagem.php');
?>
		
<div class="conthead">
<h2>Líderes</h2>
</div>
<div id="conteudo">
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		
		array('texto',		'CARGO',		'cargo',			''),
		array('resumo',		'DADOS',		'descricao',			''),
		array('foto',		'FOTO',		'imagem',		''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM tblideranca ORDER BY cargo DESC";



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