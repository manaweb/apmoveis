<? 
	define('ID_MODULO',9,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'galeria',
		'tabela'=>'tbgalerias',
		'titulo'=>'titulo',
		'id'=>'id_galeria',
		'urlfixo'=>'', 
		'pasta'=>'galeria',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT *, DATE_FORMAT(data,'%d/%m/%Y') as data FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
$ondeestou = 'Nova Galeria';
?>
                	<div class="conthead">
                        <h2>Adicionar Galeria</h2>
                    </div>
<div id="conteudo">
<?

	include('../includes/Mensagem.php');
	
	if ($dados['id_galeria']>0) $dados['imagem'] = $dados['codigo'].'/capa.jpg';
	if (empty($dados['data'])) $dados['data']=date('d/m/Y');
	if ($dados['flag_status']=='') $dados['flag_status']='1';

	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'Título',		'titulo',			'500',			'',					'',											''),
		array('text',		'Local',		'local',			'250',			'',					'',											''),
		array('data',		'Data',			'data',				'100',			'',					'',											''),
		array('flag',		'Status',		'flag_status',		'500',			'',					'',											''),
		array('file',		'Imagem',		'imagem',			'350',			1,					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>