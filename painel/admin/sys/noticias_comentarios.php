<? 
	define('ID_MODULO',1,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'noticias_comentarios',
		'tabela'=>'tbnoticias_comentarios',
		'titulo'=>'nome',
		'id'=>'id_comentario',
		'urlfixo'=>'', 
		'pasta'=>'comentarios',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Comentários</h2>
                    </div>
<div id="conteudo">
<?

	// -----------------------------------------------------------------------------------------------------------
	// Sistema de Busca
	// -----------------------------------------------------------------------------------------------------------
	$busca='';
	if ($_GET['id_noticia'] > 0) {
		$busca .= ' AND tbnoticias.id_noticia='.(int)$_GET['id_noticia'];
		$dados_busca['id_noticia']= $_GET['id_noticia'];
	}

	

	# noticias
	$noticias=array('-'=>'0');
	$tmp1s = db_consulta("SELECT * FROM tbnoticias ORDER BY titulo ASC");
	while ($tmp1 = db_lista($tmp1s)) {
		$noticias[$tmp1['titulo']." (ID - ".$tmp1['id_noticia'].")"] = $tmp1['id_noticia'];
	}


	# Os campos
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'noticias',		'id_noticia',		'250',			$noticias,			'',											''),
		
	);


	# Exibindo os campos
	echo adminBusca($campos,$Config,$dados_busca);







	// -----------------------------------------------------------------------------------------------------------
	// Listagem
	// -----------------------------------------------------------------------------------------------------------



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'NOTÍCIA',		'titulo',			''),
		array('texto',		'NOME',			'nome',				''),
		array('texto',		'EMAIL',		'email',			''),
		array('texto',		'DATA',			'data1',			''),
		array('texto',		'IP',			'ip',				''),
		array('texto',		'MENSAGEM',		'mensagem',			''),
	);


	# Consulta SQL
	$SQL = "
		SELECT 
			tbnoticias_comentarios.*,
			tbnoticias.*,
			DATE_FORMAT(tbnoticias_comentarios.datahora,'%d/%m/%Y %H:%i:%s') as data1 
		FROM 
			tbnoticias_comentarios 
			INNER JOIN tbnoticias ON (tbnoticias.id_noticia = tbnoticias_comentarios.id_noticia)
		WHERE 1
			".$busca."
		ORDER BY datahora DESC";

	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','status'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>