<? 
	define('ID_MODULO',35,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'mural',
		'tabela'=>'tbmural',
		'titulo'=>'nome',
		'id'=>'id_mural',
		'urlfixo'=>'', 
		'pasta'=>'mural',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Mural de Recados </h2>
                    </div>
<div id="conteudo">
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'NOME',			'nome',			''),
		array('texto',		'E-MAIL',		'email',			''),
		array('texto',		'DATA',			'data1',			''),
		array('resumo',		'RESUMO',		'mensagem',			''),
	);


	# Consulta SQL
	$SQL = "SELECT *, DATE_FORMAT(datahora,'%d/%m/%Y %H:%i:%s') as data1 FROM tbmural ORDER BY datahora DESC";

	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','status'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>