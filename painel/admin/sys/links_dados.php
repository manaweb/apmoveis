<? 
	define('ID_MODULO',25,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'links',
		'tabela'=>'tblinks',
		'titulo'=>'texto',
		'id'=>'id_link',
		'urlfixo'=>'', 
		'pasta'=>'links',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Adicionar Links</h2>
                    </div>
<div id="conteudo">
<?

 


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'Texto',		'texto',			'500',			'',					'',											''),
		array('text',		'URL',		'url',			'500',			'',					'<br>Ex: http://www.google.com',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>