<? 
	define('ID_MODULO',23,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'conteudo',
		'tabela'=>'tbconteudo',
		'titulo'=>'titulo',
		'id'=>'id_conteudo',
		'urlfixo'=>'', 
		'pasta'=>'conteudo',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Editar Página</h2>
                    </div>
<div id="conteudo">
<?

 

	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'Titulo',		'titulo',			'500',			'',					'',											'disabled="disabled"'),
		array('textarea',	'Texto',		'texto',			'',	            '',					'',											''),

	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>