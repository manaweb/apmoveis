<? 
	define('ID_MODULO',86,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'produtos_subcategorias',
		'tabela'=>'tbprodutos_subcategorias',
		'tabela2'=>'tbprodutos_categorias',
		'nome'=>'subcategorias',
		'id'=>'id_subcategoria',
		'urlfixo'=>'', 
		'pasta'=>'',
	);

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="produtos_subcategorias.php">Produtos</a> &rsaquo; <a href="produtos_subcategorias.php">Subcategorias</a> &rsaquo; Consultar
</div>
<div id="conteudo">
	<a  id="btnalt" href="produtos_subcategorias_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Nova Subcategoria</a>
<br />
<br />

<?
	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');




	// -----------------------------------------------------------------------------------------------------------
	// Listagem
	// -----------------------------------------------------------------------------------------------------------

	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>TÃ­tulo					2=>Fonte			3=>Url
		array('texto',		'CATEGORIA',				'categoria',			''),
		array('texto',		'NOME DA SUBCATEGORIA',		'subcategoria',			''),
	);


	# Consulta SQL
	/*$SQL = "SELECT * FROM ".$Config['tabela']." WHERE 1 ".$busca." ORDER BY titulo ASC";*/
	
	
	$SQL = "
			SELECT tbprodutos_subcategorias.*, tbprodutos_categorias.*
			FROM 
				tbprodutos_subcategorias, tbprodutos_categorias
				WHERE tbprodutos_categorias.id_categoria = tbprodutos_subcategorias.categoria
				AND	upper(tbprodutos_subcategorias.subcategoria) <> upper('todos') 		
			ORDER BY 
				tbprodutos_categorias.categoria ASC, 
				tbprodutos_subcategorias.subcategoria ASC
		   ";
	

	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';


?>
</div>
<? include('../includes/Rodape.php'); ?>