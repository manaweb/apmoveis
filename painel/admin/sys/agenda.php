<? 
	define('ID_MODULO',60,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'agenda',
		'tabela'=>'tbagenda',
		'titulo'=>'titulo',
		'id'=>'id_agenda',
		'urlfixo'=>'', 
		'pasta'=>'agenda',
	);

?>
<?
include('../includes/Mensagem.php');
?>
		
<div class="conthead">
<h2>Agenda de eventos</h2>
</div>
<div id="conteudo">
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		
		array('texto',		'TÍTULO',		'titulo',			''),
		array('texto',		'DATA',		'data1',		''),
	);


	# Consulta SQL
	$SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM tbagenda ORDER BY data DESC";



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