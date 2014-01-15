<? 
	define('ID_MODULO',17,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	#include('../includes/tinyMCE_advanced.php');

	$Config = array(
		'arquivo'=>'destaque',
		'tabela'=>'tbdestaque',
		'titulo'=>'titulo',
		'id'=>'id_destaque',
		'urlfixo'=>'', 
		'pasta'=>'destaque',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Adicionar Destaque</h2>
                    </div>
<div id="conteudo">
<?

 



	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'Título',		'titulo',			'500',			'',					'',											''),
		array('text',		'URL',			'destino',			'500',			'',					'',											''),
		array('file',		'Imagem',		'imagem',			'350',			0,					'',											''),
		array('textarea',	'Descrição',	'descricao',		array(80,10),	'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>