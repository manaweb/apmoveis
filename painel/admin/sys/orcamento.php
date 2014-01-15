<? 
	define('ID_MODULO',105,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'orcamento',
		'tabela'=>'tborcamento',
		'nome'=>'orcamento',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'orcamento',
	);

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="orcamento.php">Or&ccedil;amento</a> &rsaquo; Consultar
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
		array('texto',		'C&Oacute;DIGO',	'id',				''),
		array('texto',		'CLIENTE',			'cliente',			''),
		array('texto',		'EMAIL',			'email',			''),
		array('texto',		'DATA DE ENVIO',	'data',				''),
	);


	# Consulta SQL
	/*$SQL = "SELECT * FROM ".$Config['tabela']." WHERE 1 ".$busca." ORDER BY titulo ASC";*/
	
	
	$SQL = "
			select o.id, o.flag_status, DATE_FORMAT( o.data , '%d/%m/%Y %H:%i:%s' ) as data, concat(c.primeironome,' ',c.ultimonome) as cliente, c.email from tborcamento o, tbclientes c
			 where o.id_cliente = c.id
			 order by o.id desc
		   ";
	
	
	

	# Processando os dados
	$total = mysql_num_rows(mysql_query($SQL));
	$Lista = new Consulta($SQL,$total,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir', 'visualizar'),$Config,false);



	# Paginação
	//echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';


?>
</div>
<? include('../includes/Rodape.php'); ?>