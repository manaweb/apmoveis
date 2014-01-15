<? 
	define('ID_MODULO',31,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'ministerios_categorias',
		'tabela'=>'z_ministerios_categoria',
		'titulo'=>'categoria',
		'id'=>'id_categoria',
		'urlfixo'=>'', 
		'pasta'=>'ministerios',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Minist&eacute;rios</h2>
                    </div>
<div id="conteudo">

<a  id="btnalt" href="ministerios_categorias_dados.php"><img src="../img/add.png" align="absmiddle" /> Novo Minist&eacute;rio</a>
<br />
<br />

<?

 


	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'MINIST&Eacute;RIOS',		'categoria',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM z_ministerios_categoria ORDER BY categoria DESC";


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