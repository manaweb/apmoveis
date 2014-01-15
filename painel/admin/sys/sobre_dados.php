<? 
	define('ID_MODULO',99,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'sobre',
		'tabela'=>'historico',
		'titulo'=>'sobre',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
$ondeestou = 'videos';
?>
 <div class="conthead">
                        <h2>Editar Texto "Quem somos"</h2>
                    </div>
<div id="conteudo">
<?
 


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo					2=>Nome Campo				3=>Tamanho(px)		4=>CampoExtra		5=>Comentário								6=>Atributos
		array('textarea',	'Quem somos',					'texto',					'5000',				'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>