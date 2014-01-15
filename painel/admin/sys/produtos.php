<? 
	define('ID_MODULO',86,true);
	header('Content-Type: text/html;charset=ISO-8859-1');
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'produtos',
		'tabela'=>'tbprodutos',
		'titulo'=>'produto',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'produtos',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Produtos</h2>
                    </div>
<div id="conteudo">
<a id="btnalt"  href="produtos_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Produto</a>
<br />
<br />
<?



	# Montando os campos
	$campos = array(
		array('texto',		'NOME DO PRODUTO',				'nome',								''),
		//array('texto',		'PRE&Ccedil;O',					'preco',							''),
		array('resumo',		'DESCRI&Ccedil;&Atilde;O',		'descricao',						''),
		array('foto',		'IMAGEM 1',						'foto1',							''),
		array('foto',		'IMAGEM 2',						'foto2',							''),
		array('foto',		'IMAGEM 3',						'foto3',							''),
		array('foto',		'IMAGEM 4',						'foto4',							''),
		array('foto',		'IMAGEM 5',						'foto5',							''),
		array('texto',		'SUBCATEGORIA',					'categoria_subcategoria',			''),
	);


	# Consulta SQL
	#$SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y %H:%i') as data1 FROM tbnoticias  ORDER BY data DESC";

	$SQL = "SELECT p . * , concat(c.categoria, ' >> ', s.subcategoria) as categoria_subcategoria ,s.id_subcategoria
			FROM tbprodutos_categorias c, tbprodutos p, tbprodutos_subcategorias s
			WHERE c.id_categoria = s.categoria
			AND p.id_subcategoria = s.id_subcategoria";

	# Processando os dados
	$total = mysql_num_rows(mysql_query($SQL));
	$Lista = new Consulta($SQL,$total,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# PaginaÃ§Ã£o
	//echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
<script>
	$(function(){
		for(var i = 0; i < $('td').length; i++){
			$('td').eq(i).css('background-color','#'+$('td').eq(i).text());
			$('td').eq(i).css('color','#'+$('td').eq(i).text());
			
		}
	})
</script>
</div>
<? include('../includes/Rodape.php'); ?>