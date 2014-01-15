
<? 
	define('ID_MODULO',1,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'noticias',
		'tabela'=>'tbnoticias',
		'titulo'=>'titulo',
		'id'=>'id_noticia',
		'urlfixo'=>'', 
		'pasta'=>'noticias',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");
	$dados['titulo']=str_replace('\\','',$dados['titulo']);
	$dados['texto']=str_replace('\\','',$dados['texto']);

?>
<script>
	$(function() {
		$('input[type=checkbox]').click(function() {
			var name = $(this).attr('id');
			var regex = new RegExp("^(("+name+"))|(\[|\])+$");
			$('input').filter(function() {
				return this.name.match(regex);
			}).parents('tr').toggle('slow');
		});
	});
</script>
<?
include('../includes/Mensagem.php');
$ondeestou = 'Nova Not&iacute;cia';
?>
                	<div class="conthead">
                        <h2>Adicionar Not&iacute;cia</h2>
                    </div>
<div id="conteudo">
<?
 

	# Categoria
	$Categoria=array();
	$tmp1s = db_consulta("SELECT * FROM tbnoticias_categorias ORDER BY categoria ASC");
	while ($tmp1 = db_lista($tmp1s)) {
		$Categoria[$tmp1['categoria']]=$tmp1['id_categoria'];
	}


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'Categorias',	'id_categoria',		'150',			$Categoria,			'',											''),
		array('text',		'T&iacute;tulo',		'titulo',			'500',			'',					'',											''),
		array('text',		'Subt&iacute;tulo',		'subtitulo',			'500',			'',					'',											''),
		array('checkbox',	'Tipo de arquivo:','tipo',				'',		'',						'',								'id="audio",id="video",id="foto"'),
		array('file',		'Audio',		'audio[]',			'350',			0,					'',											'multiple="multiple"'),
		array('file',		'Fotos',		'foto[]',			'350',			0,					'',											'multiple="multiple"'),
		array('text',		'Video',		'video',			'350',			0,					'URL do Youtube',											''),
		array('textarea',	'Texto',		'texto',			'',	            '',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);


?>
</div>
<?
	include('../includes/Rodape.php');
?>