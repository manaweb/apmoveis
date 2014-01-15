<? 
	define('ID_MODULO',17,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'destaque',
		'tabela'=>'tbdestaque',
		'titulo'=>'titulo',
		'id'=>'id_destaque',
		'urlfixo'=>'', 
		'pasta'=>'destaque',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Destaques</h2>
                    </div>
<div id="conteudo">
<a  id="btnalt" href="destaque_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar novo destaque</a>
<br />
<br />
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		
		array('texto',		'TÍTULO',		'titulo',			''),
		
		array('resumo',		'URL',		'destino',		''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM tbdestaque ORDER BY titulo DESC";



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