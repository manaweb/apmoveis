<? 
	define('ID_MODULO',4,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'ver_departamentos',
		'tabela'=>'tbdepartamentos_categorias',
		'titulo'=>'categoria',
		'id'=>'id_categoria',
		'urlfixo'=>'', 
		'pasta'=>'links',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
$ondeestou = 'Editar Categorias';
?>
 <div class="conthead">
                        <h2>Adicionar Departamento</h2>
                    </div>
<div id="conteudo">
<?
 


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'Departamento',		'categoria',			'500',			'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>