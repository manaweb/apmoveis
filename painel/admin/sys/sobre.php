<? 
	define('ID_MODULO',99,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'sobre',
		'tabela'=>'historico',
		'titulo'=>'sobre',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>"Quem Somos"</h2>
                    </div>
<div id="conteudo">

<br />
<br />

<?

 


	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título				2=>Fonte			3=>Url
		array('texto',		'Quem Somos',			'texto',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM historico ORDER BY id DESC";


	# Processando os dados
	$Lista = new Consulta($SQL,1,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('editar'),$Config,false);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>