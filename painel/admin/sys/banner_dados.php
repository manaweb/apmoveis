<? 
	define('ID_MODULO',83,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	include('../includes/tinyMCE_advanced.php');

	$Config = array(
		'arquivo'=>'banner',
		'tabela'=>'tbpublicidade',
		'tabela2'=> 'tbpublicidade_areas',
		'titulo'=>'titulo',
		'id'=>'id_publicidade',
		'urlfixo'=>'', 
		'pasta'=>'banner',
	);


	if ($_GET['ID']>0) {
		$dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");
	}

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="banner.php">Publicidade</a> &rsaquo; <a href="banner.php">Banners</a> &rsaquo; <?=($dados[$Config['id']]>0)?'Editar: '.$dados[$Config['titulo']]:'Adicionar';?>
</div>
<div id="conteudo">
<?

	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');

	
	# Area -> 
	
	$Areas=array();
	$a1 = db_consulta("SELECT * FROM tbpublicidade_areas ORDER BY area ASC");
	while ($b1=db_lista($a1)) $Areas[$b1['area']]=$b1['id_area'];

	
	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'Area',			'id_area',			'250',			$Areas,				'',											''),
		array('text',		'T&iacute;tulo','titulo',			'500',			'',					'',											''),
		//array('text',		'URL',			'destino',			'200',			'',					'',											''),
		//array('text',		'Largura X:',	'dimx',				'100',			'',					'pixels',									''),
		//array('text',		'Largura Y:',	'dimy',				'100',			'',					'pixels',									''),
		array('file',		'Arquivo',		'arquivo',			'350',		   	1,					'Largura: 1900px  Altura: 590px',			''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);

?>
</div>
<?
	include('../includes/Rodape.php');
?>