<? 
	define('ID_MODULO',14,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	include('../includes/tinyMCE_advanced.php');

	$Config = array(
		'arquivo'=>'newsletter_enviar',
		'tabela'=>'user',
		'titulo'=>'nome',
		'id'=>'email',
		'urlfixo'=>'', 
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Enviar Newsletter</h2>
                    </div>
<div id="conteudo">
<?

 



	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo					2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'Seu Nome',					'nomede',			'500',			'',					'',											''),
		array('text',		'Seu Email',				'dequem',			'500',			'',					'',											''),
		array('text',		'Assunto do e-mail',		'assunto',			'500',			'',					'',											''),
		array('textarea',	'Mensagem',					'mensagem',			array(80,25),	'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>