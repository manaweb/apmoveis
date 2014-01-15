<? 
	define('ID_MODULO',66,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'pedidos',
		'tabela'=>'tboracao',
		'titulo'=>'texto',
		'id'=>'id_oracao',
		'urlfixo'=>'', 
		'pasta'=>'oracao',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Pedidos de oração</h2>
                    </div>
<div id="conteudo">


<?

 
	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'NOME',		'nome',			''),
		array('texto',		'PEDIDO',		'pedido',			''),
		array('texto',		'DATA',		'data',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM tboracao ORDER BY data DESC";


	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>