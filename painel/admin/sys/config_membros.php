<? 
	define('ID_MODULO',31,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'cargos_categorias',
		'tabela'=>'z_cargos_categoria',
		'titulo'=>'categoria',
		'id'=>'id_categoria',
		'urlfixo'=>'', 
		'pasta'=>'cargos',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Configura&ccedil;&otilde;es de Minist&eacute;rios e Cargos da Igreja</h2>
                    </div>
<div id="conteudo">
<br />
<br />
<br />
<a id="btnalt" href="ministerios_categorias.php"><img src="../img/bteditar.png" align="absmiddle" /> Administrar Minist&eacute;rios da Igreja</a>

<a id="btnalt" href="cargos_categorias.php"><img src="../img/user.png" align="absmiddle" /> Administrar Cargos da Igreja</a>
<br />
<br />
<br />
<br />
<br />
<br />

<?

 
/*

	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'CARGOS',		'categoria',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM z_cargos_categoria ORDER BY categoria DESC";


	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';




*/




?>
</div>
<? include('../includes/Rodape.php'); ?>