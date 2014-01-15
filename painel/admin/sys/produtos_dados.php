<? 
	define('ID_MODULO',86,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	include('../includes/tinyMCE_advanced.php');

	$Config = array(
		'arquivo'=>'produtos',
		'tabela'=>'tbprodutos',
		'titulo'=>'produtos',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'produtos',
	);


	if ($_GET['ID']>0) {
		$dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");
	}

?>
<style>
	img{
		max-width: 350px;
	}
	.btnExcluirImagem {
		margin-left: 11px;
	}

</style>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="produtos.php">Produtos</a>  <?=($dados[$Config['id']]>0)?'Editar: '.$dados[$Config['titulo']]:'Adicionar';?>
</div>
<div id="conteudo">
<?

	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');

	
	# Area -> 
	
	$Areas=array();
	$a1 = db_consulta("select concat(c.categoria, ' >> ', s.subcategoria) as categoria_subcategoria, s.id_subcategoria from tbprodutos_categorias c, tbprodutos_subcategorias s where c.id_categoria = s.categoria and s.subcategoria <> 'Todos'");
	while ($b1=db_lista($a1)) $Areas[$b1['categoria_subcategoria']]=$b1['id_subcategoria'];
	
	$variacoes=array();
	$a1 = db_consulta("Select * from tbprodutos_variacoes");
	while ($b1=db_lista($a1)) $variacoes[$b1['variacao']]=$b1['id'];

	
	# Montando os Dados
	$campos = array(
	#	0=>Tipo			1=>Titulo							2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário					6=>Atributos
		array('text',		'Nome',							'nome',				'500',			'',					'',								''),
		array('checkbox',	'Produto em oferta',				'emOferta',				'20',			'',					'',								''),
		//array('text',		'Pre&ccedil;o',					'preco',			'200',			'',					'',								'id=preco'),
		array('textarea',	'Descri&ccedil;&atilde;o',		'descricao',		'350',		   	'',					'',								''),
		array('file',		'Imagem 1',						'foto1',			'350',			'',					'Imagem Obrigat&oacute;ria',	''),
		array('file',		'Imagem 2',						'foto2',			'350',			'',					'Imagem opcional',				''),
		array('file',		'Imagem 3',						'foto3',			'350',			'',					'Imagem opcional',				''),
		array('file',		'Imagem 4',						'foto4',			'350',			'',					'Imagem opcional',				''),
		array('file',		'Imagem 5',						'foto5',			'350',			'',					'Imagem opcional',				''),
		array('select',		'Subcategoria',					'id_subcategoria',	'250',			$Areas,				'',								''),
	);
	

	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);

?>
</div>
<?
	include('../includes/Rodape.php');
?>
<script>
	$(function() {
		$('input[type=checkbox]').change(function() {
			if ($(this).is(':checked'))
				$(this).val(1);
			else
				$(this).val(0);
		});
	})
</script>