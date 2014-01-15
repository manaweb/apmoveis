<? 
	define('ID_MODULO',14,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'newsletter',
		'tabela'=>'user',
		'titulo'=>'nome',
		'id'=>'email',
		'urlfixo'=>'', 
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Lista de e-mails </h2>
                    </div>
<div id="conteudo">
<!--<a id="btnalt"  href="newsletter_enviar.php"><img src="../img/enviarr.png" align="absmiddle" /> Enviar Newsletter</a>-->
 


<?

	$SQL = "SELECT DISTINCT email FROM user ORDER BY email ASC";
	$Lista = new Consulta($SQL,99999,$PGATUAL);
	if (db_linhas($Lista->consulta)>0) {
	?>
	
	
	<div>
	
        
	
<?
                    $i=0;
                    while ($linha = db_lista($Lista->consulta)) { $i++;
?>
				

<?=$linha['email'];?>,

            <?
                }
            ?>

        </div>
<?
	}

 
 
/*

	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'NOME',			'nome',				''),
		array('texto',		'EMAIL',		'email',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM user ORDER BY nome ASC";



	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';




*/




?>
</div>
<? include('../includes/Rodape.php'); ?>