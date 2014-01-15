<? 
	define('ID_MODULO',37,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'downloads',
		'tabela'=>'tbdownloads',
		'titulo'=>'titulo',
		'id'=>'id_download',
		'urlfixo'=>'', 
		'pasta'=>'downloads',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Downloads de arquivos</h2>
                    </div>
<div id="conteudo">
<a  id="btnalt" href="downloads_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Novo Arquivo</a>
<br />
<br />
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		
		array('texto',		'TÍTULO',			'titulo',			''),
		array('resumo',		'CATEGORIA',		'categoria',		''),
		array('resumo',		'DESCRICAO',		'descricao',		''),

	);


	# Consulta SQL
	$SQL = "SELECT
			tbdownloads.*, tbdownloads_categorias.* 
	
	FROM 	tbdownloads
			LEFT JOIN tbdownloads_categorias ON (tbdownloads_categorias.id_categoria = tbdownloads.id_categoria)

	ORDER BY tbdownloads.id_download DESC";



	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
	$linha['id_categoria']=utf8_encode($linha['categoria']);
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>