<? 
	define('ID_MODULO',83,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'banner',
		'tabela'=>'tbpublicidade',
		'tabela2'=>'tbpublicidade_areas',
		'nome'=>'titulo',
		'id'=>'id_publicidade',
		'urlfixo'=>'', 
		'pasta'=>'banner',
	);

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="banner.php">Publicidade</a> &rsaquo; <a href="banner.php">Banners</a> &rsaquo; Consultar
</div>
<div id="conteudo">
<?
	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');




	// -----------------------------------------------------------------------------------------------------------
	// Listagem
	// -----------------------------------------------------------------------------------------------------------

	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>TÃ­tulo			2=>Fonte			3=>Url
		array('texto',		'AREA',				'area',				''),
		array('texto',		'T&Iacute;TULO',	'titulo',			''),
		array('texto',		'URL',				'destino',			''),
		array('foto',		'IMAGEM',			'arquivo',			''),
	);


	# Consulta SQL
	/*$SQL = "SELECT * FROM ".$Config['tabela']." WHERE 1 ".$busca." ORDER BY titulo ASC";*/
	
	
	$SQL = "
			SELECT 
				tbpublicidade.*,
				tbpublicidade_areas.*
			FROM 
				tbpublicidade
				INNER JOIN tbpublicidade_areas ON (tbpublicidade_areas.id_area = tbpublicidade.id_area)			
			ORDER BY 
				tbpublicidade_areas.area ASC, 
				tbpublicidade.titulo ASC
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