<? 
	define('ID_MODULO',88,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'videos',
		'tabela'=>'tbvideos',
		'titulo'=>'titulo',
		'id'=>'id_video',
		'urlfixo'=>'', 
		'pasta'=>'videos',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Vídeos</h2>
                    </div>
<div id="conteudo">
<a  id="btnalt" href="videos_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Novo Vídeo</a>
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
			tbvideos.*, tbvideos_categorias.* 
	
	FROM 	tbvideos
			LEFT JOIN tbvideos_categorias ON (tbvideos_categorias.id_categoria = tbvideos.id_categoria)

	ORDER BY tbvideos.id_video DESC";



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