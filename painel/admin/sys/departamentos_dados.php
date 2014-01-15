<? 
	define('ID_MODULO',4,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'departamentos',
		'tabela'=>'tbdepartamentos',
		'titulo'=>'titulo',
		'id'=>'id_departamentos',
		'urlfixo'=>'', 
		'pasta'=>'departamentos',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT *, DATE_FORMAT(data,'%d/%m/%Y') as data FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");
	$dados['texto']=str_replace('\\','',$dados['texto']);
?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Adicionar Conteúdo</h2>
                    </div>
<div id="conteudo">
<?

 
 
	# Categoria
	$Categoria=array();
	$tmp1s = db_consulta("SELECT * FROM tbdepartamentos_categorias ORDER BY categoria ASC");
	while ($tmp1 = db_lista($tmp1s)) {
		$Categoria[$tmp1['categoria']]=$tmp1['id_categoria'];
	}

	
	
	if ($dados['id_departamentos']>0) $dados['imagem'] = $dados['codigo'].'/capa.jpg';
	if (empty($dados['data'])) $dados['data']=date('d/m/Y');
	if ($dados['flag_status']=='') $dados['flag_status']='1';

	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'Selecione o Departamento',	'id_categoria',		'150',			$Categoria,			'',											''),
		array('text',		'Título',		'titulo',			'500',			'',					'',											''),
		array('text',		'Subtítulo',		'subtitulo',			'250',			'',					'',											''),
		array('data',		'Data',			'data',				'100',			'',					' <- Clique no calendário',					''),
		array('flag',		'Online?',		'flag_status',		'500',			'',					'',											''),
		array('file',		'Imagem',		'imagem',			'350',			1,					'',											''),
		array('textarea',	'Texto',		'texto',			'',	            '',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>