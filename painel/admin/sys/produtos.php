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

// -----------------------------------------------------------------------------------------------------------
	// Sistema de Busca
	// -----------------------------------------------------------------------------------------------------------
	$busca='';
	if ($_GET['id'] > 0) {
		$busca .= ' AND p.id='.(int)$_GET['id'];
		$dados_busca['id']= $_GET['id'];
	}

	

	# noticias
	$noticias=array('-'=>'0');
	$tmp1s = db_consulta("SELECT * FROM tbprodutos ORDER BY id DESC");
	while ($tmp1 = db_lista($tmp1s)) {
		$noticias[$tmp1['nome'].' - <span style="font-weight: bold;font-size: 18px;">'.$tmp1['id'].'</span>'] = $tmp1['id'];
	}


	# Os campos
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'Produtos',		'id',		'250',			$noticias,			'',											''),
		
	);

	# Exibindo os campos
	echo adminBusca($campos,$Config,$dados_busca);


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
			WHERE (c.id_categoria = s.categoria
			AND p.id_subcategoria = s.id_subcategoria) $busca";

	# Processando os dados
	$total = mysql_num_rows(mysql_query($SQL));
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# PaginaÃ§Ã£o
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









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