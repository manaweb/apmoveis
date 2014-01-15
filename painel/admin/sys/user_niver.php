<? 
	define('ID_MODULO',31,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'user',
		'tabela'=>'user',
		'nome'=>'nome',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'materias',
	);


 
$niver = (!empty($_GET['niver'])) ? $_GET['niver'] : '';
$niver = mysql_real_escape_string($niver);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Relatório de Aniversariantes</h2>
                    </div>
<div id="conteudo">
<a id="btnalt" href="user_niver_imprimir.php?niver=<?echo $niver;?>" target="_blank"><img src="../img/imprimir.png" align="absmiddle" /> Imprimir Relatório</a>
<br />
<br />
<h3>Listar ANIVERSARIANTES</h3>

<form name="niver" method="GET" action="user_niver.php"> 
<select name="niver" style="height:30px!important; border:1px solid #ccc; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;" height="30px"  size="1">
  <option>Selecione</option>
  <option value="01">Janeiro</option>
  <option value="02">Fevereiro</option>
  <option value="03">Março</option>
  <option value="04">Abril</option>
  <option value="05">Maio</option>
  <option value="06">Junho</option>
  <option value="07">Julho</option>
  <option value="08">Agosto</option>
  <option value="09">Setembro</option>
  <option value="10">Outubro</option>
  <option value="11">Novembro</option>
  <option value="12">Dezembro</option>
</select>
<input type="submit" value="listar" style="height:30px!important;" height="30px" id="btn" />
</form>

<br><br><br><br>


<?

if ($_GET['niver']>0) $sql = "
	
	SELECT *, DATE_FORMAT(nascimento,'%d/%m/%Y') as data1, DATE_FORMAT(nascimento,'%d') as nascimento1 FROM user WHERE DATE_FORMAT(nascimento,'%m') BETWEEN ".(int)$_GET['niver']." AND ".(int)$_GET['niver']." ORDER BY nascimento1 ASC
	
	";
	else {echo 'Nenhum relatório foi criado.'; exit;}
?>

 
<?
 

	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'Nome',			'nome',		''),
		array('texto',		'Telefone',		'telefone',			''),
		array('texto',		'Celular',		'celular',			''),
		array('resumo',		'E-mail',		'email',			''),
		array('texto',		'Aniversário',	'data1',			''),
		array('foto',		'Foto',			'imagem',			''),
	);





	# Processando os dados
	$Lista = new Consulta($sql,999999,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
	$linha['categoria']=utf8_encode($linha['categoria']);
	$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array(),$Config,false);












?>
</div>
<? include('../includes/Rodape.php'); ?>