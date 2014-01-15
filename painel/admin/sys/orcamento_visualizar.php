<? 
	define('ID_MODULO',105,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'orcamento',
		'tabela'=>'tborcamento',
		'titulo'=>'titulo',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'orcamento',
	);


	if ($_GET['ID']>0){ 
		$dados = db_dados("SELECT o.id, DATE_FORMAT( o.data,  '%d/%m/%Y %H:%i:%s' ) AS data, CONCAT( c.primeironome,  ' ', c.ultimonome ) AS cliente, c.email, c.telefone, c.celular, c.cep, c.logradouro, c.numero, c.bairro, c.cidade, c.estado 
							FROM tborcamento o, tbclientes c
							WHERE o.id = ".$_GET['ID']."
							AND o.id_cliente = c.id
							LIMIT 1;");
		db_consulta('update tborcamento set flag_status = true where id='.$_GET['ID']);
	}

?>
<?
include('../includes/Mensagem.php');
?>
<div id="conteudo">
<?

 
 


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo				2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'C&oacute;digo',		'id',				'300',			'',					'',											''),
		array('text',		'Cliente',				'cliente',			'300',			'',					'',											''),
		array('text',		'Email',				'email',			'300',			'',					'',											''),
		array('text',		'Telefone',				'telefone',			'300',			'',					'',											''),
		array('text',		'Celular',				'celular',			'300',			'',					'',											''),
		array('text',		'CEP',					'cep',				'300',		   	'',					'',											''),
		array('text',		'Logradouro',			'logradouro',		'300',		   	'',					'',											''),
		array('text',		'N&uacute;mero',		'numero',			'300',		   	'',					'',											''),
		array('text',		'Bairro',				'bairro',			'300',		   	'',					'',											''),
		array('text',		'Cidade',				'cidade',			'300',		   	'',					'',											''),
		array('text',		'Estado',				'estado',			'300',		   	'',					'',											''),
		array('text',		'Data de Envio',		'data',				'300',		   	'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos2($campos,$Config,$dados, $_GET['ID']);






?>
</div>
<style>
	.consulta * {
		text-align: center !important;
	}
</style>
<?
	include('../includes/Rodape.php');
?>