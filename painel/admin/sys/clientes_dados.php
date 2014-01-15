
<? 
	define('ID_MODULO',1,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'noticias',
		'tabela'=>'tbclientes',
		'titulo'=>'primeironome',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'noticias',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");
	$dados['titulo']=str_replace('\\','',$dados['titulo']);
	$dados['texto']=str_replace('\\','',$dados['texto']);


include('../includes/Mensagem.php');
$ondeestou = 'Nova Not&iacute;cia';
?>
                	<div class="conthead">
                        <h2>Editar Cliente</h2>
                    </div>
<div id="conteudo">
<?php


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'Cliente',		'primeironome',			'500',			'',					'',											''),
		array('text',		'E-mail',		'email',			'500',			'',					'',											''),
		array('text',	'Celular','celular',				'',		'',						'',								''),
		array('text',		'Telefone',		'telefone',			'350',			0,					'',											'multiple="multiple"'),
		array('text',		'CEP',		'cep',			'350',			0,					'',											''),
		array('text',		'Logradouro',		'logradouro',			'350',			0,					'',											''),
		array('text',	'Numero',		'numero',			'',	            '',					'',											''),
		array('text',	'Bairro',		'bairro',			'',	            '',					'',											''),
		array('text',	'Cidade',		'cidade',			'',	            '',					'',											''),
		array('text',	'Estado',		'estado',			'',	            '',					'',											'')
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);


?>
</div>
<?
	include('../includes/Rodape.php');
?>