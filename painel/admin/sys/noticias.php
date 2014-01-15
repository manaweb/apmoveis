<? 
	define('ID_MODULO',1,true);
	header('Content-Type: text/html;charset=ISO-8859-1');
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'noticias',
		'tabela'=>'tbnoticias',
		'titulo'=>'titulo',
		'id'=>'id_noticia',
		'urlfixo'=>'', 
		'pasta'=>'noticias',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Not&iacute;&ccedil;cias</h2>
                    </div>
<div id="conteudo">
<a id="btnalt"  href="noticias_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar nova not&iacute;cia</a>
<br />
<br />
<?



	# Montando os campos
	$campos = array(
		array('texto',		'CATEGORIA',	'categoria',		''),
		array('texto',		'T&Iacute;TULO',		'titulo',			''),
		array('texto',		'SUBT&Iacute;TULO',		'subtitulo',			''),
		array('texto',		'CR&Eacute;DITOS',		'creditos',			''),
		array('texto',		'DATA',			'data1',			''),
		array('resumo',		'RESUMO',		'texto',			''),
	);


	# Consulta SQL
	#$SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y %H:%i') as data1 FROM tbnoticias  ORDER BY data DESC";

	$SQL = "SELECT 
				tbnoticias.*, tbnoticias_categorias.*, DATE_FORMAT(data,'%d/%m/%Y %H:%i') as data1
			FROM 
				tbnoticias
				LEFT JOIN tbnoticias_categorias ON (tbnoticias_categorias.id_categoria = tbnoticias.id_categoria) 
			ORDER BY 
				tbnoticias.data DESC
			";

	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
	$linha['categoria']=utf8_encode($linha['categoria']);
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# PaginaÃ§Ã£o
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>