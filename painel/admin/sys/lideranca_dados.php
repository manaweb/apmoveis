<? 
	define('ID_MODULO',63,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'lideranca',
		'tabela'=>'tblideranca',
		'titulo'=>'titulo',
		'id'=>'id_lideranca',
		'urlfixo'=>'', 
		'pasta'=>'lideranca',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Adicionar Lider</h2>
                    </div>
<div id="conteudo">
<?

 
 


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'Cargo',		'cargo',			'500',			'',					'',											''),
		array('file',		'Foto',			'imagem',				'255',			'',					'',					''),
		array('textarea',		'Nome, Contatos, Descrição',	'descricao',			'500',				'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>