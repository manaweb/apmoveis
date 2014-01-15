<? 
	define('ID_MODULO',23,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'conteudo',
		'tabela'=>'tbconteudo',
		'titulo'=>'titulo',
		'id'=>'id_conteudo',
		'urlfixo'=>'', 
		'pasta'=>'conteudo',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Páginas Fixas</h2>
                    </div>
<div id="conteudo">
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'TÍTULO',		'titulo',			$Config['arquivo'].'_dados.php?ID={id_conteudo}'),
		array('resumo',		'RESUMO',		'texto',			''),

	);


	# Consulta SQL
	$SQL = "SELECT * FROM tbconteudo ORDER BY titulo DESC";


	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('editar'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>