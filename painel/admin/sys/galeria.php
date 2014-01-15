<? 
	define('ID_MODULO',9,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'galeria',
		'tabela'=>'tbgalerias',
		'titulo'=>'titulo',
		'id'=>'id_galeria',
		'urlfixo'=>'', 
		'pasta'=>'galeria',
	);

?>
<?
include('../includes/Mensagem.php');
$ondeestou = 'Galerias';
?>
                	<div class="conthead">
                        <h2>Galeria de fotos</h2>
                    </div>
<div id="conteudo">
<a  id="btnalt" href="galeria_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar nova galeria</a>
<br />
<br />
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'DATA',			'data1',			''),
		array('texto',		'TÍTULO',		'titulo',			''),
		array('texto',		'LOCAL',		'local',			''),
	);


	# Consulta SQL
	#$SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y %H:%i') as data1 FROM tbnoticias  ORDER BY data DESC";

	$SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM tbgalerias ORDER BY data DESC, titulo ASC";

	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar','status','fotos'),$Config,false);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>