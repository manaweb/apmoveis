<? 
	define('ID_MODULO',47,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'loja',
		'tabela'=>'tbloja',
		'titulo'=>'titulo',
		'id'=>'id_produto',
		'urlfixo'=>'', 
		'pasta'=>'loja',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Adicionar novo produto</h2>
                    </div>
<div id="conteudo">
<?

 	# Categorias brasileiros
	$Categorias=array();
	$tmp1s = db_consulta("SELECT * FROM tbloja_categorias ORDER BY categoria ASC");
	while ($tmp1 = db_lista($tmp1s)) {
		$Categorias[$tmp1['categoria']]=$tmp1['id_categoria'];
	}



	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>ComentÃ¡rio								6=>Atributos
		array('select',		'Categoria',		'id_categoria',			'',			$Categorias,					'',											''),
		array('text',		'TÃ­tulo',		'titulo',			'500',			'',					'',											''),
		array('text',		'PreÃ§o',		'preco',			'100',			'',					'ex: 100.00',											''),
		array('file',		'Imagem',		'imagem',			'350',			0,					'',											''),
		array('textarea',	'DescriÃ§Ã£o do produto',	'descricao',		array(80,10),	'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>