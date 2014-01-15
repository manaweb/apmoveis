<? 
	define('ID_MODULO',86,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'produtos_variacoes',
		'tabela'=>'tbprodutos_variacoes',
		'titulo'=>'variacoes',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Varia&ccedil;&otilde;es do Produtos</h2>
                    </div>
<div id="conteudo">

<a  id="btnalt" href="produtos_variacoes_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Nova Varia&ccedil;&atilde;o</a>
<br />
<br />

<?

 


	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'VARIA&Ccedil;&AtildeO',		'variacao',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM tbprodutos_variacoes ORDER BY variacao DESC";


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