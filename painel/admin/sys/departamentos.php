<? 
	define('ID_MODULO',4,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'departamentos',
		'tabela'=>'tbdepartamentos',
		'titulo'=>'titulo',
		'id'=>'id_departamentos',
		'urlfixo'=>'', 
		'pasta'=>'departamentos',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Departamentos</h2>
                    </div>
<div id="conteudo">
<a  id="btnalt" href="departamentos_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar nova notícia</a>
<br />
<br />
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
 
		array('texto',		'TÍTULO',		'titulo',			''),
		array('texto',		'DEPARTAMENTO',	'categoria',			''),
		array('texto',		'DATA',			'data1',			''),
		array('resumo',		'RESUMO',		'texto',			''),
	);


	# Consulta SQL
	#$SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y %H:%i') as data1 FROM tbdepartamentos  ORDER BY data DESC";

	$SQL = "SELECT 
				tbdepartamentos.*, tbdepartamentos_categorias.*, DATE_FORMAT(data,'%d/%m/%Y') as data1
			FROM 
				tbdepartamentos
				LEFT JOIN tbdepartamentos_categorias ON (tbdepartamentos_categorias.id_categoria = tbdepartamentos.id_categoria) 
			ORDER BY 
				tbdepartamentos.data DESC
			";
 
	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
	$linha['categoria']=$linha['categoria'];
		$dados[] = $linha;
	}

	# Listando
	echo adminLista($campos,$dados,array('excluir','editar','status','fotos'),$Config,false);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>