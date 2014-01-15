<? 
	define('ID_MODULO',26,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'materias',
		'tabela'=>'tbmaterias',
		'titulo'=>'titulo',
		'id'=>'id_materia',
		'urlfixo'=>'', 
		'pasta'=>'materias',
	);

?>
<div id="acessibilidade">
	Você est&aacute; aqui: <a href="materias.php">Matérias</a> &rsaquo; Consultar
</div>
<div id="conteudo">
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'CATEGORIA',	'categoria',		''),
		array('texto',		'TÍTULO',		'titulo',			''),
		array('texto',		'DATA',			'data1',			''),
		array('resumo',		'RESUMO',		'texto',			''),
	);


	# Consulta SQL
	#$SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y %H:%i') as data1 FROM tbmaterias  ORDER BY data DESC";


	$SQL = "SELECT 
				tbmaterias.*, tbmaterias_categorias.*, DATE_FORMAT(data,'%d/%m/%Y %H:%i') as data1
			FROM 
				tbmaterias
				LEFT JOIN tbmaterias_categorias ON (tbmaterias_categorias.id_categoria = tbmaterias.id_categoria) 
			ORDER BY 
				tbmaterias.data DESC
			";


	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$linha['categoria']=utf8_encode($linha['categoria']);
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>