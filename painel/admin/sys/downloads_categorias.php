<? 
	define('ID_MODULO',37,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'downloads_categorias',
		'tabela'=>'tbdownloads_categorias',
		'titulo'=>'categoria',
		'id'=>'id_categoria',
		'urlfixo'=>'', 
		'pasta'=>'downloads',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Categorias de Downloads</h2>
                    </div>
<div id="conteudo">

<a  id="btnalt" href="downloads_categorias_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Nova Categoria</a>
<br />
<br />

<?

 


	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'CATEGORIAS',		'categoria',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM tbdownloads_categorias ORDER BY categoria DESC";


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