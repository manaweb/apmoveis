<? 
	define('ID_MODULO',88,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'videos',
		'tabela'=>'tbvideos',
		'titulo'=>'titulo',
		'id'=>'id_video',
		'urlfixo'=>'', 
		'pasta'=>'videos',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Vídeos</h2>
                    </div>
<div id="conteudo">
<?

 	# Categorias brasileiros
	$Categorias=array();
	$tmp1s = db_consulta("SELECT * FROM tbvideos_categorias ORDER BY categoria ASC");
	while ($tmp1 = db_lista($tmp1s)) {
		$Categorias[$tmp1['categoria']]=$tmp1['id_categoria'];
	}



	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'Categoria',		'id_categoria',			'',			$Categorias,					'',											''),
		array('text',		'T&iacute;tulo do V&iacute;deo',		'titulo',			'500',			'',					'',											''),
		array('text',		'C&oacute;digo da URL',		'video',			'500',			'',					'<span style="color:red;"><br>Exemplo: </span>www.youtube.com/watch?v=<b><span style="color:#555;">B2lhR2aBpo0</span></b> - Cole apenas o c&oacute;digo do final',											''),
		array('textarea',	'Descri&ccedil;&atilde;o do v&iacute;deo',	'descricao',		array(80,10),	'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>