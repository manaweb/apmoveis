<? 
	define('ID_MODULO',9,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'galeria_comentarios',
		'tabela'=>'tbgalerias_comentarios',
		'titulo'=>'nome',
		'id'=>'id_comentario',
		'urlfixo'=>'', 
		'pasta'=>'comentarios',
	);

?>
<?
include('../includes/Mensagem.php');
$ondeestou = 'Comentários';
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
	if ($_GET['id_galeria'] > 0) {
		$busca .= ' AND tbgalerias.id_galeria='.(int)$_GET['id_galeria'];
		$dados_busca['id_galeria']= $_GET['id_galeria'];
	}

	

	# Galerias
	$Galerias=array('-'=>'0');
	$tmp1s = db_consulta("SELECT * FROM tbgalerias ORDER BY titulo ASC");
	while ($tmp1 = db_lista($tmp1s)) {
		$Galerias[$tmp1['titulo']." (ID - ".$tmp1['id_galeria'].")"] = $tmp1['id_galeria'];
	}


	# Os campos
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'Galeria',		'id_galeria',		'250',			$Galerias,			'',											''),
		
	);


	# Exibindo os campos
	echo adminBusca($campos,$Config,$dados_busca);







	// -----------------------------------------------------------------------------------------------------------
	// Listagem
	// -----------------------------------------------------------------------------------------------------------



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'GALERIA',		'titulo',			''),
		array('texto',		'NOME',			'nome',				''),
		array('texto',		'EMAIL',		'email',			''),
		array('texto',		'DATA',			'data1',			''),
		array('texto',		'IP',			'ip',				''),
		array('texto',		'MENSAGEM',		'mensagem',			''),
	);


	# Consulta SQL
	$SQL = "
		SELECT 
			tbgalerias_comentarios.*,
			tbgalerias.*,
			DATE_FORMAT(tbgalerias_comentarios.datahora,'%d/%m/%Y %H:%i:%s') as data1 
		FROM 
			tbgalerias_comentarios 
			INNER JOIN tbgalerias ON (tbgalerias.id_galeria = tbgalerias_comentarios.id_galeria)
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