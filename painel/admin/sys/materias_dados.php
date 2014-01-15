<? 
	define('ID_MODULO',26,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	include('../includes/tinyMCE_advanced.php');

	$Config = array(
		'arquivo'=>'materias',
		'tabela'=>'tbmaterias',
		'titulo'=>'titulo',
		'id'=>'id_materia',
		'urlfixo'=>'', 
		'pasta'=>'materias',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");
	$dados['titulo']=str_replace('\\','',$dados['titulo']);
	$dados['texto']=str_replace('\\','',$dados['texto']);

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="materias.php">Matérias</a> &rsaquo; <?=($dados[$Config['id']]>0)?'Editar: '.$dados[$Config['titulo']]:'Adicionar';?>
</div>
<div id="conteudo">
<?

	include('../includes/Mensagem.php');


	# Categoria
	$Categoria=array();
	$tmp1s = db_consulta("SELECT * FROM tbmaterias_categorias ORDER BY categoria ASC");
	while ($tmp1 = db_lista($tmp1s)) {
		$Categoria[utf8_encode($tmp1['categoria'])]=$tmp1['id_categoria'];
	}


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'Categorias',	'id_categoria',		'150',			$Categoria,			'',											''),
		array('text',		'Título',		'titulo',			'500',			'',					'',											''),
		array('file',		'Imagem',		'imagem',			'350',			0,					'',											''),
		array('textarea',	'Texto',		'texto',			array(80,25),	'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>