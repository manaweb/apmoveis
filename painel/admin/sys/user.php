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


//Mantem os dados no formul&aacute;rio caso haja erros
$nome = (!empty($_GET['nome'])) ? $_GET['nome'] : '';
$nome = mysql_real_escape_string($nome);

$sobrenome = (!empty($_GET['sobrenome'])) ? $_GET['sobrenome'] : '';
$sobrenome = mysql_real_escape_string($sobrenome);

$mae = (!empty($_GET['mae'])) ? $_GET['mae'] : '';
$mae = mysql_real_escape_string($mae);

$pai = (!empty($_GET['pai'])) ? $_GET['pai'] : '';
$pai = mysql_real_escape_string($pai);

$conjuge = (!empty($_GET['conjuge'])) ? $_GET['conjuge'] : '';
$conjuge = mysql_real_escape_string($conjuge);

$filhos = (!empty($_GET['filhos'])) ? $_GET['filhos'] : '';
$filhos = mysql_real_escape_string($filhos);
 
 

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Membros Cadastrados</h2>
                    </div>
<div id="conteudo">
<a id="btnalt" href="user_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Novo Membro</a>
<br />
<br />

<?php
$databusca=date("Y-m-d");
?>


 
<?
	# Consulta SQL
	$sql = "SELECT
			user.*, z_cargos_categoria.*, DATE_FORMAT(data,'%d/%m/%Y') as data1
	
	FROM 	user
			LEFT JOIN z_cargos_categoria ON (z_cargos_categoria.id_categoria = user.posicaoeclisiastica)
	
	WHERE
	user.nome LIKE '%$nome%'
	AND  user.sobrenome LIKE '%$sobrenome%'
	AND   user.pai LIKE '%$pai%'
	AND  user.mae LIKE '%$mae%'
	AND  user.filhos LIKE '%$filhos%'
	AND  user.conjuge LIKE '%$conjuge%'
	AND  user.data LIKE '%$data%'
	AND  user.flag_status LIKE '%$status%'
	
	ORDER BY user.nome ASC
	
	";
 
?>

					<!-- ESTATÍSTICAS DE MEMBROS CADASTRADOS -->
                	<div class="contentbox">
                    	<ul class="summarystats">
                        	<li>
							<? $query = mysql_query($sql) or die(mysql_error());
							$total = mysql_num_rows($query); ?>
                            	<p class="statcount"><?echo $total;?></p> <p>Membros Encontrados</p>  
                            </li>
							<li>
							<? $sql2 = "SELECT * FROM user WHERE data > DATE_SUB(NOW(), INTERVAL 1 DAY)";
								$query = mysql_query($sql2) or die(mysql_error());
								$total = mysql_num_rows($query);  ?>
                            	<p class="statcount"><?echo $total;?></p> <p>Cadastros nas &Uacute;timas 24 horas</p>  <p class="statview"><? echo '<a href=?data=' . $databusca . '>' ?>ver</a></p>
                            </li>
							<li>
							<? $sql3 = "SELECT * FROM user WHERE flag_status=1";
								$query = mysql_query($sql3) or die(mysql_error());
								$total = mysql_num_rows($query);  ?>
                            	<p class="statcount"><?echo $total;?></p> <p>Ativos</p>  <p class="statview"><a href="?status=1">ver</a></p>
                            </li>
							<li>
							<? $sql3 = "SELECT * FROM user WHERE flag_status=0";
								$query = mysql_query($sql3) or die(mysql_error());
								$total = mysql_num_rows($query);  ?>
                            	<p class="statcount"><?echo $total;?></p> <p>Inativos</p>  <p class="statview"><a href="?status=0">ver</a></p>
                            </li>
                        </ul>
                        
                    </div>
					
					

<h3>Organizar por</h3>

<form name="jump"> 
<select style="height:30px!important; border:1px solid #ccc; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;" height="30px"  size="1" name="menu" onChange="location=document.jump.menu.options[document.jump.menu.selectedIndex].value;" value="Ir">
  <option>Selecione</option>
  <option value="user_data.php">Data de cadastro</option>
  <option value="user.php">Ordem Alfabetica</option>
</select>
</form>

<br><br><br><br>

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
<form name="frm1" method="GET" action="<? $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" >


    	<h3>Busca Personalizada</h3>
        <dl style="float:left; margin:0 20px 0 0;">
        	<dt><label for="nome">Pesquisar pelo nome:</label></dt>
            <dd><input type="text" name="nome" value="<?php echo $nome ?>" size="32" style="height:30px!important; border:1px solid #ccc; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;" height="30px"  maxlength="99128" /></dd>
        </dl>
		        <dl style="float:left; margin:0 20px 0 0;">
        	<dt><label for="nome">Pesquisar pelo sobrenome:</label></dt>
            <dd><input type="text" name="sobrenome" value="<?php echo $sobrenome ?>" size="32" style="height:30px!important; border:1px solid #ccc; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;" height="30px"  maxlength="99128" /></dd>
        </dl>
        <dl style="float:left; margin:0;">
        	<dt><label for="sobrenome">Pesquisar pelo nome do esposo(a):</label></dt>
            <dd><input type="text" name="conjuge" value="<?php echo $conjuge ?>" size="32"style="height:30px!important; border:1px solid #ccc; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;" height="30px"  maxlength="99200" /></dd>
        </dl>
		<dl style="clear:both; float:left; margin:20px 20px 0 0;">
        	<dt><label for="familia">Pesquisar pelo nome do pai:</label></dt>
            <dd><input type="text" name="pai" value="<?php echo $pai ?>" size="32" style="height:30px!important; border:1px solid #ccc; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;" height="30px" maxlength="99200" /></dd>
        </dl>
		        <dl style="float:left; margin:20px 20px 0 0;">
        	<dt><label for="nome">Pesquisar pelo nome da mae:</label></dt>
            <dd><input type="text" name="mae" value="<?php echo $mae ?>" size="32" style="height:30px!important; border:1px solid #ccc; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;" height="30px"  maxlength="99128" /></dd>
        </dl>
		<dl style="float:left; margin:20px 0 0 0;">
        	<dt><label for="talento">Pesquisar pelo nome do filho:</label></dt>
            <dd><input type="text" name="filhos" value="<?php echo $filhos ?>" size="32" style="height:30px!important; border:1px solid #ccc; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;" height="30px"  maxlength="99200" /></dd>
        </dl>
		<br />
       
	  <dl style="clear:both; float:left; margin:20px 20px 0 0;">	   
      <dt><input type="submit" name="submit" value="Pesquisar Membros"  style="height:35px!important;" height="35px" id="btn" /> </dt>
	   </dl>
	   
	  <!-- <dl style=" float:left; margin:30px 0 0 0;">	   
       <dt><a id="btnalt" href="user_busca.php"><img src="../img/buscaavancada.png" align="absmiddle" />Fazer Busca Avançada</a></dt>
	   </dl>-->
	   
</form>
			<div class="clear"></div>	
	<br><br>
 
<?
 

	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'Nome',	'nome',		''),
		array('texto',		'Telefone',		'telefone',			''),
		array('texto',		'Celular',			'celular',			''),
		array('resumo',		'E-mail',		'email',			''),
		array('texto',		'Cargo',		'categoria',			''),
		array('foto',		'Foto',		'imagem',			''),
	);





	# Processando os dados
	$Lista = new Consulta($sql,50,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
	$linha['categoria']=utf8_encode($linha['categoria']);
	$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar','status','visualizar','imprimir'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>