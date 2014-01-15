<? 
	define('ID_MODULO',44,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'congregacoes',
		'tabela'=>'tbcongregacoes',
		'titulo'=>'nome',
		'id'=>'id_congregacao',
		'urlfixo'=>'', 
		'pasta'=>'congregacoes',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Adicionar Congregação</h2>
                    </div>
<div id="conteudo">
<?

 	# Estados brasileiros
	$Estados=array();
	$tmp1s = db_consulta("SELECT * FROM estados ORDER BY estado ASC");
	while ($tmp1 = db_lista($tmp1s)) {
		$Estados[$tmp1['estado']]=$tmp1['id_estado'];
	}



	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'Nome da E',		'nome',			'500',			'',					'',											''),
		array('text',		'Nome do Pastor',			'pastor',			'500',			'',					'',											''),
		array('text',		'Telefone',			'telefone',			'500',			'',					'',											''),
		array('text',		'Endereço',			'endereco',			'500',			'',					'',											''),
		array('select',		'Estado',		'id_estado',			'',			$Estados,					'',											''),
		array('text',		'Cidade',			'cidade',			'500',			'',					'',											''),
		array('text',		'Bairro',			'bairro',			'500',			'',					'',											''),
		array('text',		'Cep',			'cep',			'500',			'',					'',											''),
		array('text',		'Site',			'site',			'500',			'',					'',											''),
		array('file',		'Foto da Fachada',		'imagem',			'350',			0,					'',											''),
		array('textarea',	'Mapa do Google (Acesse http://maps.google.com.br/ para pesquisar o local e depois cole aqui)',	'mapa',		array(80,10),	'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>