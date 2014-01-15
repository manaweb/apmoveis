<? 
	define('ID_MODULO',44,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'congregacoes',
		'tabela'=>'tbcongregacoes',
		'titulo'=>'nome',
		'id'=>'id_congregacao',
		'urlfixo'=>'', 
		'pasta'=>'congregacoes',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Congregações</h2>
                    </div>
<div id="conteudo">
<a  id="btnalt" href="congregacoes_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar nova Congregação</a>
<br />
<br />
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		
		array('texto',		'IGREJA',			'nome',			''),
		array('resumo',		'PASTOR',		'pastor',		''),
		array('resumo',		'ESTADO',		'estado',		''),

	);


	# Consulta SQL
	$SQL = "SELECT
			tbcongregacoes.*, estados.* 
	
	FROM 	tbcongregacoes
			LEFT JOIN estados ON (estados.id_estado = tbcongregacoes.id_estado)

	ORDER BY tbcongregacoes.id_estado DESC";



	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
	$linha['id_estado']=utf8_encode($linha['estado']);
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>