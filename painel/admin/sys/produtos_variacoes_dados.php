<? 
	define('ID_MODULO',86,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'produtos_variacoes',
		'tabela'=>'tbprodutos_variacoes',
		'titulo'=>'variacoes',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
$ondeestou = 'produtos';
?>
 <div class="conthead">
                        <h2>Adicionar Varia&ccedil;&atilde;o de Produto</h2>
                    </div>
<div id="conteudo">
<?
 


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'Varia&ccedil;&atilde;o de produto',		'variacao',			'500',			'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>