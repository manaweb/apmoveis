<? 
	define('ID_MODULO',4,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'departamentos_comentarios',
		'tabela'=>'tbdepartamentos_comentarios',
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
	if ($_GET['id_departamentos'] > 0) {
		$busca .= ' AND tbdepartamentos.id_departamentos='.(int)$_GET['id_departamentos'];
		$dados_busca['id_departamentos']= $_GET['id_departamentos'];
	}

	

	# departamentos
	$departamentos=array('-'=>'0');
	$tmp1s = db_consulta("SELECT * FROM tbdepartamentos ORDER BY titulo ASC");
	while ($tmp1 = db_lista($tmp1s)) {
		$departamentos[$tmp1['titulo']." (ID - ".$tmp1['id_departamentos'].")"] = $tmp1['id_departamentos'];
	}


	# Os campos
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'departamentos',		'id_departamentos',		'250',			$departamentos,			'',											''),
		
	);


	# Exibindo os campos
	echo adminBusca($campos,$Config,$dados_busca);







	// -----------------------------------------------------------------------------------------------------------
	// Listagem
	// -----------------------------------------------------------------------------------------------------------



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'DEPARTAMENTO',		'titulo',			''),
		array('texto',		'NOME',			'nome',				''),
		array('texto',		'EMAIL',		'email',			''),
		array('texto',		'DATA',			'data1',			''),
		array('texto',		'IP',			'ip',				''),
		array('texto',		'MENSAGEM',		'mensagem',			''),
	);


	# Consulta SQL
	$SQL = "
		SELECT 
			tbdepartamentos_comentarios.*,
			tbdepartamentos.*,
			DATE_FORMAT(tbdepartamentos_comentarios.datahora,'%d/%m/%Y %H:%i:%s') as data1 
		FROM 
			tbdepartamentos_comentarios 
			INNER JOIN tbdepartamentos ON (tbdepartamentos.id_departamentos = tbdepartamentos_comentarios.id_departamentos)
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