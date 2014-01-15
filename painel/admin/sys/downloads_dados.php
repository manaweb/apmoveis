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


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Downloads</h2>
                    </div>
<div id="conteudo">
<?

 	# Categorias brasileiros
	$Categorias=array();
	$tmp1s = db_consulta("SELECT * FROM tbdownloads_categorias ORDER BY categoria ASC");
	while ($tmp1 = db_lista($tmp1s)) {
		$Categorias[$tmp1['categoria']]=$tmp1['id_categoria'];
	}



	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'Categoria',		'id_categoria',			'',			$Categorias,					'',											''),
		array('text',		'Nome do arquivo',		'titulo',			'500',			'',					'',											''),
		array('file',		'Arquivo para donwload',		'arquivo',			'350',			0,					'',											''),
		array('textarea',	'Descrição do que se trata',	'descricao',		array(80,10),	'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>