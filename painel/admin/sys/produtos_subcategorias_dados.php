<? 
	define('ID_MODULO',86,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	include('../includes/tinyMCE_advanced.php');

	$Config = array(
		'arquivo'=>'produtos_subcategorias',
		'tabela'=>'tbprodutos_subcategorias',
		'tabela2'=>'tbprodutos_categorias',
		'nome'=>'subcategorias',
		'id'=>'id_subcategoria',
		'urlfixo'=>'', 
		'pasta'=>'',
	);


	if ($_GET['ID']>0) {
		$dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");
	}

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="produtos_subcategorias.php">Produtos</a> &rsaquo; <a href="produtos_subcategorias.php">Subcategorias</a> &rsaquo; Consultar
</div>
<div id="conteudo">
<?

	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');

	
	# Area -> 
	
	$Areas=array();
	$a1 = db_consulta("SELECT * FROM tbprodutos_categorias ORDER BY categoria ASC");
	while ($b1=db_lista($a1)) $Areas[$b1['categoria']]=$b1['id_categoria'];

	
	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'Categoria',	'categoria',			'250',			$Areas,				'',											''),
		array('text',		'Subcategoria', 'subcategoria',			'500',			'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);

?>
</div>
<?
	include('../includes/Rodape.php');
?>