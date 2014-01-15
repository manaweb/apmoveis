<? 
	define('ID_MODULO',1,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'noticias_categorias',
		'tabela'=>'tbnoticias_categorias',
		'titulo'=>'categoria',
		'id'=>'id_categoria',
		'urlfixo'=>'', 
		'pasta'=>'links',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Categorias</h2>
                    </div>
<div id="conteudo">

<a id="btnalt" href="noticias_categorias_dados.php"><img src="../img/add.png" align="absmiddle" /> Nova categoria</a>
<br />
<br />

<?

 


	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'CATEGORIA',		'categoria',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM tbnoticias_categorias ORDER BY categoria DESC";


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