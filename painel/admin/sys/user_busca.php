<? 
	define('ID_MODULO',31,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	
header ('location: user.php');
	
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
$sobrenome = (!empty($_GET['sobrenome'])) ? $_GET['sobrenome'] : '';
$cpf = (!empty($_GET['cpf'])) ? $_GET['cpf'] : '';
$endereco = (!empty($_GET['endereco'])) ? $_GET['endereco'] : '';
$email = (!empty($_GET['email'])) ? $_GET['email'] : '';
$estadocivil = (!empty($_GET['estadocivil'])) ? $_GET['estadocivil'] : '';
$data = (!empty($_GET['data'])) ? $_GET['data'] : '';


$databusca=date("Y-m-d");


//pega os dados do formulário
	$ensinomedio = $_GET['ensinomedio'];
   $superior = $_GET['superior'];
   $musculacao = $_GET['musculacao'];
   $abdominal = $_GET['abdominal'];
   $alongamento = $_GET['alongamento'];
   $boxe = $_GET['boxe'];
   $gap = $_GET['gap'];
   $danca = $_GET['danca'];
   $jump = $_GET['jump'];
   $loca = $_GET['loca'];
   $pilates = $_GET['pilates'];
   $running = $_GET['running'];
   $spinning = $_GET['spinning'];
   $step = $_GET['step'];
   $tae = $_GET['tae'];
   $yoga = $_GET['yoga'];
   $outros = $_GET['outros'];
   $batack = $_GET['batack'];
   $bcombat = $_GET['bcombat'];
   $bjam = $_GET['bjam'];
   $bpump = $_GET['bpump'];
   $powerj = $_GET['powerj'];
   $powerp = $_GET['powerp'];
   $powerb = $_GET['powerb'];
   $powers = $_GET['powers'];
   $hbike = $_GET['hbike'];
   $hgestante = $_GET['hgestante'];
   $hginastica = $_GET['hginastica'];
   $hjump = $_GET['hjump'];
   $hterapia = $_GET['hterapia'];
   $natacao = $_GET['natacao'];
   $nbebe = $_GET['nbebe'];
   $ninfantil = $_GET['ninfantil'];
   $afisica = $_GET['afisica'];
   $ptrainer = $_GET['ptrainer'];
   $oassessorias = $_GET['oassessorias'];
   $odanca = $_GET['odanca'];
   $oescolar = $_GET['oescolar'];
   $ofutebol = $_GET['ofutebol'];
   $oesportes = $_GET['oesportes'];
   $olaboral = $_GET['olaboral'];
   $oluta = $_GET['oluta'];
   $orecreacao = $_GET['orecreacao'];
   $musculacao2 = $_GET['musculacao2'];
   $abdominal2 = $_GET['abdominal2'];
   $alongamento2 = $_GET['alongamento2'];
   $boxe2 = $_GET['boxe2'];
   $gap2 = $_GET['gap2'];
   $danca2 = $_GET['danca2'];
   $jump2 = $_GET['jump2'];
   $loca2 = $_GET['loca2'];
   $pilates2 = $_GET['pilates2'];
   $running2 = $_GET['running2'];
   $spinning2 = $_GET['spinning2'];
   $step2 = $_GET['step2'];
   $tae2 = $_GET['tae2'];
   $yoga2 = $_GET['yoga2'];
   $outros2 = $_GET['outros2'];
   $batack2 = $_GET['batack2'];
   $bcombat2 = $_GET['bcombat2'];
   $bjam2 = $_GET['bjam2'];
   $bpump2 = $_GET['bpump2'];
   $powerj2 = $_GET['powerj2'];
   $powerp2 = $_GET['powerp2'];
   $powerb2 = $_GET['powerb2'];
   $powers2 = $_GET['powers2'];
   $hbike2 = $_GET['hbike2'];
   $hgestante2 = $_GET['hgestante2'];
   $hginastica2 = $_GET['hginastica2'];
   $hjump2 = $_GET['hjump2'];
   $hterapia2 = $_GET['hterapia2'];
   $natacao2 = $_GET['natacao2'];
   $nbebe2 = $_GET['nbebe2'];
   $ninfantil2 = $_GET['ninfantil2'];
   $afisica2 = $_GET['afisica2'];
   $ptrainer2 = $_GET['ptrainer2'];
   $oassessorias2 = $_GET['oassessorias2'];
   $odanca2 = $_GET['odanca2'];
   $oescolar2 = $_GET['oescolar2'];
   $ofutebol2 = $_GET['ofutebol2'];
   $oesportes2 = $_GET['oesportes2'];
   $olaboral2 = $_GET['olaboral2'];
   $oluta2 = $_GET['oluta2'];
   $orecreacao2 = $_GET['orecreacao2'];
   
   $gerencia1 = $_GET['gerencia1'];
   $gerencia2 = $_GET['gerencia2'];
   $gerencia3 = $_GET['gerencia3'];
   $gerencia4 = $_GET['gerencia4'];
   $gerencia5 = $_GET['gerencia5'];
   
   
   $avaliacaofisica = $_GET['avaliacaofisica'];   
   $avaliacaofisica2 = $_GET['avaliacaofisica2'];
   
   $personaltrainer = $_GET['personaltrainer'];
   $personaltrainer2 = $_GET['personaltrainer2'];
   
   $estagiario = $_GET['estagiario'];
   $profissional = $_GET['profissional'];

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Busca de Membros Avançada</h2>
                    </div>
<div id="conteudo">
<a id="btnalt" href="user_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Novo Membro</a>
<br />
<br />

<h3>Estat&iacute;sticas</h3>
<?
$sql = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM user WHERE musculacao LIKE '%$musculacao%'
	
								AND	nome LIKE '%$nome%'
							    AND sobrenome LIKE '%$sobrenome%'
								AND cpf LIKE '%$cpf%'
								AND estadocivil LIKE '%$estadocivil%'
								AND endereco LIKE '%$endereco%'
								AND email LIKE '%$email%'
								AND data LIKE '%$data%'
								
   AND abdominal LIKE '%$abdominal%'
   AND alongamento LIKE '%$alongamento%'
   AND boxe LIKE '%$boxe%'
   AND gap LIKE '%$gap%'
   AND danca LIKE '%$danca%'
   AND jump LIKE '%$jump%'
   AND loca LIKE '%$loca%'
   AND pilates LIKE '%$pilates%'
   AND running LIKE '%$running%'
   AND spinning LIKE '%$spinning%'
   AND step LIKE '%$step%'
   AND tae LIKE '%$tae%'
   AND yoga LIKE '%$yoga%'
   AND outros LIKE '%$outros%'
   AND batack LIKE '%$batack%'
   AND bcombat LIKE '%$bcombat%'
   AND bjam LIKE '%$bjam%'
   AND bpump LIKE '%$bpump%'
   AND powerj LIKE '%$powerj%'
   AND powerp LIKE '%$powerp%'
   AND powerb LIKE '%$powerb%'
   AND powers LIKE '%$powers%'
   AND hbike LIKE '%$hbike%'
   AND hgestante LIKE '%$hgestante%'
   AND hginastica LIKE '%$hginastica%'
   AND hjump LIKE '%$hjump%'
   AND hterapia LIKE '%$hterapia%'
   AND natacao LIKE '%$natacao%'
   AND nbebe LIKE '%$nbebe%'
   AND ninfantil LIKE '%$ninfantil%'
   AND afisica LIKE '%$afisica%'
   AND ptrainer LIKE '%$ptrainer%'
   AND oassessorias LIKE '%$oassessorias%'
   AND odanca LIKE '%$odanca%'
   AND oescolar LIKE '%$oescolar%'
   AND ofutebol LIKE '%$ofutebol%'
   AND oesportes LIKE '%$oesportes%'
   AND olaboral LIKE '%$olaboral%'
   AND oluta LIKE '%$oluta%'
   AND orecreacao LIKE '%$orecreacao%'
   AND musculacao2 LIKE '%$musculacao2%'
   AND abdominal2 LIKE '%$abdominal2%'
   AND alongamento2 LIKE '%$alongamento2%'
   AND boxe2 LIKE '%$boxe2%'
   AND gap2 LIKE '%$gap2%'
   AND danca2 LIKE '%$danca2%'
   AND jump2 LIKE '%$jump2%'
   AND loca2 LIKE '%$loca2%'
   AND pilates2 LIKE '%$pilates2%'
   AND running2 LIKE '%$running2%'
   AND spinning2 LIKE '%$spinning2%'
   AND step2 LIKE '%$step2%'
   AND tae2 LIKE '%$tae2%'
   AND yoga2 LIKE '%$yoga2%'
   AND outros2 LIKE '%$outros2%'
   AND batack2 LIKE '%$batack2%'
   AND bcombat2 LIKE '%$bcombat2%'
   AND bjam2 LIKE '%$bjam2%'
   AND bpump2 LIKE '%$bpump2%'
   AND powerj2 LIKE '%$powerj2%'
   AND powerp2 LIKE '%$powerp2%'
   AND powerb2 LIKE '%$powerb2%'
   AND powers2 LIKE '%$powers2%'
   AND hbike2 LIKE '%$hbike2%'
   AND hgestante2 LIKE '%$hgestante2%'
   AND hginastica2 LIKE '%$hginastica2%'
   AND hjump2 LIKE '%$hjump2%'
   AND hterapia2 LIKE '%$hterapia2%'
   AND natacao2 LIKE '%$natacao2%'
   AND nbebe2 LIKE '%$nbebe2%'
   AND ninfantil2 LIKE '%$ninfantil2%'
   AND afisica2 LIKE '%$afisica2%'
   AND ptrainer2 LIKE '%$ptrainer2%'
   AND oassessorias2 LIKE '%$oassessorias2%'
   AND odanca2 LIKE '%$odanca2%'
   AND oescolar2 LIKE '%$oescolar2%'
   AND ofutebol2 LIKE '%$ofutebol2%'
   AND oesportes2 LIKE '%$oesportes2%'
   AND olaboral2 LIKE '%$olaboral2%'
   AND oluta2 LIKE '%$oluta2%'
   AND orecreacao2 LIKE '%$orecreacao2%'
   
   AND gerencia1 LIKE '%$gerencia1%'
   AND gerencia2 LIKE '%$gerencia2%'
   AND gerencia3 LIKE '%$gerencia3%'
   AND gerencia4 LIKE '%$gerencia4%'
   AND gerencia5 LIKE '%$gerencia5%'
   
   
   AND avaliacaofisica LIKE '%$avaliacaofisica%'   
   AND avaliacaofisica2 LIKE '%$avaliacaofisica2%'
   
   AND personaltrainer LIKE '%$personaltrainer%'
   AND personaltrainer2 LIKE '%$personaltrainer2%'
   
   AND estagiario LIKE '%$estagiario%'
   AND profissional LIKE '%$profissional%'
   
   AND ensinomedio LIKE '%$ensinomedio%'
   AND superior LIKE '%$superior%'
								ORDER BY nome ASC";
$query = mysql_query($sql) or die(mysql_error());
$total = mysql_num_rows($query); // retorna o número de linhas da ultima query
echo 'Usu&aacute;rios Encontrados: ' . $total;

$sql = "SELECT * FROM user WHERE data > DATE_SUB(NOW(), INTERVAL 1 DAY)";
$query = mysql_query($sql) or die(mysql_error());
$total = mysql_num_rows($query); // retorna o número de linhas da ultima query
echo '<br>Cadastros nas &Uacute;timas 24 horas: <a href=?data=' . $databusca . '>' . $total . '</a>';

$sql = "SELECT * FROM user";
$query = mysql_query($sql) or die(mysql_error());
$total = mysql_num_rows($query); // retorna o número de linhas da ultima query
echo '<br>Total: ' . $total;
?>
<!--
<br><br>

<h3>Organizar por</h3>

<form name="jump"> 
<select size="1" name="menu" onChange="location=document.jump.menu.options[document.jump.menu.selectedIndex].value;" value="Ir">
	<option>Selecione</option>
  <option value="user_data.php">Data de cadastro</option>
  <option value="user.php">Ordem Alfabetica</option>
</select>
</form>
-->
<br><br>

<form value=" name="form1" method="GET" action="<? $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" class="niceform">


    	<h2>FILTRAR CANDIDATOS</h2>

		<br><br>
		
		<dl style="float:left; margin:0 20px 0 0;">
        	<dt><label for="email">Nome:</label></dt>
            <dd><input type="text" name="nome" value="<?php echo $nome ?>" size="32" maxlength="99128" /></dd>
        </dl>
        <dl style="float:left; margin:0 20px 0 0;">
        	<dt><label for="password">Sobrenome:</label></dt>
            <dd><input type="text" name="sobrenome" value="<?php echo $sobrenome ?>" size="32" maxlength="99200" /></dd>
        </dl>
		<dl style="float:left; margin:0 20px 0 0;">
        	<dt><label for="password">CPF:</label></dt>
            <dd><input type="text" name="cpf" value="<?php echo $cpf ?>" size="32" maxlength="11" /></dd>
        </dl>
		<dl style="float:left; margin:0 20px 0 0;">
        	<dt><label for="password">Endere&ccedil;o:</label></dt>
            <dd><input type="text" name="endereco" value="<?php echo $endereco ?>" size="32" maxlength="11" /></dd>
        </dl>
		<dl style="float:left; margin:0 20px 0 0;">
        	<dt><label for="password">E-mail:</label></dt>
            <dd><input type="text" name="email" value="<?php echo $email ?>" size="32" maxlength="11" /></dd>
        </dl>
		<dl>
        	<dt><label for="password">Estado Civil:</label></dt>
            <dd><input type="text" name="estadocivil" value="<?php echo $estadocivil ?>" size="32" maxlength="11" /></dd>
        </dl>
		<br><br>
		
		<h2>Forma&ccedil;&atilde;o Educacional</h2><br>
        <dl>
        	<dt><label for="color">Ensino M&eacute;dio:</label></dt><br>
            <dd>
            	<input type="checkbox" name="ensinomedio" id="ensinomedio"  value="Completo" /><label for="colorBlue" class="opt">Completo</label>
                <input type="checkbox" name="ensinomedio" id="ensinomedio"  value="Incompleto" /><label for="colorRed" class="opt">Incompleto</label>
            </dd>
        </dl><br>
		<dl>
        	<dt><label for="color">Superior:</label></dt><br>
            <dd>
            	<input type="checkbox" name="superior" id="superior"  value="Completo" /><label for="colorBlue" class="opt">Completo</label>
                <input type="checkbox" name="superior" id="superior"  value="Incompleto" /><label for="colorRed" class="opt">Incompleto</label>
                <input type="checkbox" name="superior" id="superior"  value="Cursando" /><label for="colorGreen" class="opt">Cursando</label>
            </dd>
        </dl>
		
		<br><br>
		
		<h2>Interesse Profissional em outras &aacute;reas (&aacute;reas afins)</h2>
        <br><dl>
            <dd>
			
			<div style="float:left; margin:0 150px 0 0;">
			<input type="checkbox" name="gerencia1" value="1" /><label class="opt"><b>Ger&ecirc;ncia</b></label><br>
			<input type="checkbox" name="gerencia2" value="1" /><label class="opt"><b>Consultoria Comercial</b></label><br>
			<input type="checkbox" name="gerencia3" value="1" /><label class="opt"><b>Recep&ccedil;&atilde;o</b></label><br>
			</div>			
			<input type="checkbox" name="gerencia4" value="1" /><label class="opt"><b>Nutri&ccedil;&atilde;o</b></label><br>
			<input type="checkbox" name="gerencia5" value="1" /><label class="opt"><b>Fisioterapia</b></label><br>
			</dd>
			
			<div style="clear:both;"></div>
			
        	
			
        </dl>
		
		<br><br>
		<h2>Interesses</p></h2><br>
        <dl>
            <dd>
			
			<input type="checkbox" name="estagiario" value="1" /><label class="opt"><b>Estagi&aacute;rio</b></label><br>
			<input type="checkbox" name="profissional" value="1" /><label class="opt"><b>Profissional</b></label><br>
			
			<br>
			
			<div style="float:left; margin:0 150px 0 0;">
			<h2>Com experi&ecirc;ncia</h2><br>
			<input type="checkbox" name="avaliacaofisica" value="1" /><label class="opt"><b>Avalia&ccedil;&atilde;o F&iacute;sica</b></label><br>
			<input type="checkbox" name="personaltrainer" value="1" /><label class="opt"><b>Personal Trainer</b></label><br>
			<input type="checkbox" name="musculacao" value="1" /><label class="opt"><b>Muscula&ccedil;&atilde;o</b></label><br>
			
			<br>
			<b>Gin&aacute;stica</b><br>
			<br><input type="checkbox" name="abdominal" value="1" /><label class="opt">Abdominal</label>
			<br><input type="checkbox" name="alongamento" value="1" /><label class="opt">Alongamento</label>
			<br><input type="checkbox" name="boxe" value="1" /><label class="opt">Boxe</label>
			<br><input type="checkbox" name="gap" value="1" /><label class="opt">Coxa/G&uacute;teo (GAP)</label>
			<br><input type="checkbox" name="danca" value="1" /><label class="opt">Dan&ccedil;a</label>
			<br><input type="checkbox" name="jump" value="1" /><label class="opt">Trampolim</label>
			<br><input type="checkbox" name="loca" value="1" /><label class="opt">Local</label>
			<br><input type="checkbox" name="pilates" value="1" /><label class="opt">Pilates</label>
			<br><input type="checkbox" name="running" value="1" /><label class="opt">Corrida Indoor</label>
			<br><input type="checkbox" name="spinning" value="1" /><label class="opt">Ciclismo Indoor</label>
			<br><input type="checkbox" name="step" value="1" /><label class="opt">Step</label>
			<br><input type="checkbox" name="tae" value="1" /><label class="opt">Tae Fight</label>
			<br><input type="checkbox" name="yoga" value="1" /><label class="opt">Yoga</label>
			<br>
			<br><i><b>Body System</b></i><br>
			<br><input type="checkbox" name="batack" value="1" /><label class="opt">Body Attack</label>
			<br><input type="checkbox" name="bcombat" value="1" /><label class="opt">Body Combat</label>
			<br><input type="checkbox" name="bjam" value="1" /><label class="opt">Body Jam</label>
			<br><input type="checkbox" name="bpump" value="1" /><label class="opt">Body Pump</label>
			<br><input type="checkbox" name="powers" value="1" /><label class="opt">Body Step</label>
			<br><input type="checkbox" name="powerb" value="1" /><label class="opt">Body Balance</label>
			<br><input type="checkbox" name="powerj" value="1" /><label class="opt">Power Jump</label>
			<br><input type="checkbox" name="powerp" value="1" /><label class="opt">Power Poll</label>
			
			<br><br><b>Aqu&aacute;tico</b><br>
			<br><input type="checkbox" name="hbike" value="1" /><label class="opt">Hidrobike</label>
			<br><input type="checkbox" name="hgestante" value="1" /><label class="opt">Hidrogestante</label>
			<br><input type="checkbox" name="hginastica" value="1" /><label class="opt">Hidrogin&aacute;stica</label>
			<br><input type="checkbox" name="hjump" value="1" /><label class="opt">Hidrojump</label>
			<br><input type="checkbox" name="hterapia" value="1" /><label class="opt">Hidroterapia</label>
			<br><input type="checkbox" name="natacao" value="1" /><label class="opt">Nata&ccedil;&atilde;o</label>
			<br><input type="checkbox" name="nbebe" value="1" /><label class="opt">Nata&ccedil;&atilde;o beb&ecirc;</label>
			<br><input type="checkbox" name="ninfantil" value="1" /><label class="opt">Nata&ccedil;&atilde;o Infantil</label>
			
			<!--
			<br>
			<br><input type="checkbox" name="afisica" value="1" /><label class="opt"><b>Avalia&ccedil;&atilde;o F&iacute;sica<b></label>
			<br><input type="checkbox" name="ptrainer" value="1" /><label class="opt"><b>Personal Trainer<b></label>
			-->
			
			<br><br><b>Outras &aacute;reas</b><br>
			<br><input type="checkbox" name="oassessorias" value="1" /><label class="opt">Assessorias</label>
			<br><input type="checkbox" name="odanca" value="1" /><label class="opt">Dan&ccedil;a</label>
			<br><input type="checkbox" name="oescolar" value="1" /><label class="opt">Escolar</label>
			<br><input type="checkbox" name="ofutebol" value="1" /><label class="opt">Escolinha Futebol</label>
			<br><input type="checkbox" name="oesportes" value="1" /><label class="opt">Esportes</label>
			<br><input type="checkbox" name="olaboral" value="1" /><label class="opt">Laboral</label>
			<br><input type="checkbox" name="oluta" value="1" /><label class="opt">Luta</label>
			<br><input type="checkbox" name="orecreacao" value="1" /><label class="opt">Recrea&ccedil;&atilde;o</label>
			</div>
			
			
			
			<h2>Sem experi&ecirc;ncia</h2><br>
			<input type="checkbox" name="avaliacaofisica2" value="1" /><label class="opt"><b>Avalia&ccedil;&atilde;o F&iacute;sica</b></label><br>
			<input type="checkbox" name="personaltrainer2" value="1" /><label class="opt"><b>Personal Trainer</b></label><br>
			<input type="checkbox" name="musculacao2" value="1" /><label class="opt"><b>Muscula&ccedil;&atilde;o</b></label><br>
			<br>
			<b>Gin&aacute;stica</b><br>
			<br><input type="checkbox" name="abdominal2" value="1" /><label class="opt">Abdominal</label>
			<br><input type="checkbox" name="alongamento2" value="1" /><label class="opt">Alongamento</label>
			<br><input type="checkbox" name="boxe2" value="1" /><label class="opt">Boxe</label>
			<br><input type="checkbox" name="gap2" value="1" /><label class="opt">Coxa/G&uacute;teo (GAP)</label>
			<br><input type="checkbox" name="danca2" value="1" /><label class="opt">Dan&ccedil;a</label>
			<br><input type="checkbox" name="jump2" value="1" /><label class="opt">Trampolim</label>
			<br><input type="checkbox" name="loca2" value="1" /><label class="opt">Local</label>
			<br><input type="checkbox" name="pilates2" value="1" /><label class="opt">Pilates</label>
			<br><input type="checkbox" name="running2" value="1" /><label class="opt">Corrida Indoor</label>
			<br><input type="checkbox" name="spinning2" value="1" /><label class="opt">Ciclismo Indoor</label>
			<br><input type="checkbox" name="step2" value="1" /><label class="opt">Step</label>
			<br><input type="checkbox" name="tae2" value="1" /><label class="opt">Tae Fight</label>
			<br><input type="checkbox" name="yoga2" value="1" /><label class="opt">Yoga</label>
<br>
			<br><i><b>Body System</b></i><br>
			<br><input type="checkbox" name="batack2" value="1" /><label class="opt">Body Attack</label>
			<br><input type="checkbox" name="bcombat2" value="1" /><label class="opt">Body Combat</label>
			<br><input type="checkbox" name="bjam2" value="1" /><label class="opt">Body Jam</label>
			<br><input type="checkbox" name="bpump2" value="1" /><label class="opt">Body Pump</label>
			<br><input type="checkbox" name="powers2" value="1" /><label class="opt">Body Step</label>
			<br><input type="checkbox" name="powerb2" value="1" /><label class="opt">Body Balance</label>
			<br><input type="checkbox" name="powerj2" value="1" /><label class="opt">Power Jump</label>
			<br><input type="checkbox" name="powerp2" value="1" /><label class="opt">Power Poll</label>
			
			<br><br><b>Aqu&aacute;tico</b><br>
			<br><input type="checkbox" name="hbike2" value="1" /><label class="opt">Hidrobike</label>
			<br><input type="checkbox" name="hgestante2" value="1" /><label class="opt">Hidrogestante</label>
			<br><input type="checkbox" name="hginastica2" value="1" /><label class="opt">Hidrogin&aacute;stica</label>
			<br><input type="checkbox" name="hjump2" value="1" /><label class="opt">Hidrojump</label>
			<br><input type="checkbox" name="hterapia2" value="1" /><label class="opt">Hidroterapia</label>
			<br><input type="checkbox" name="natacao2" value="1" /><label class="opt">Nata&ccedil;&atilde;o</label>
			<br><input type="checkbox" name="nbebe2" value="1" /><label class="opt">Nata&ccedil;&atilde;o beb&ecirc;</label>
			<br><input type="checkbox" name="ninfantil2" value="1" /><label class="opt">Nata&ccedil;&atilde;o Infantil</label>
			
			<!--
			<br>
			<br><input type="checkbox" name="afisica2" value="1" /><label class="opt"><b>Avalia&ccedil;&atilde;o F&iacute;sica<b></label>
			<br><input type="checkbox" name="ptrainer2" value="1" /><label class="opt"><b>Personal Trainer<b></label>
			-->
			
			<br><br><b>Outras &aacute;reas</b><br>
			<br><input type="checkbox" name="oassessorias2" value="1" /><label class="opt">Assessorias</label>
			<br><input type="checkbox" name="odanca2" value="1" /><label class="opt">Dan&ccedil;a</label>
			<br><input type="checkbox" name="oescolar2" value="1" /><label class="opt">Escolar</label>
			<br><input type="checkbox" name="ofutebol2" value="1" /><label class="opt">Escolinha Futebol</label>
			<br><input type="checkbox" name="oesportes2" value="1" /><label class="opt">Esportes</label>
			<br><input type="checkbox" name="olaboral2" value="1" /><label class="opt">Laboral</label>
			<br><input type="checkbox" name="oluta2" value="1" /><label class="opt">Luta</label>
			<br><input type="checkbox" name="orecreacao2" value="1" /><label class="opt">Recrea&ccedil;&atilde;o</label>

			
             </dd>
        </dl>
		
		<br>
        	
            		<input type="image" name="submit" id="submit" src="http://empregafitness.com.br/admin/sys/buscar.jpg" /></dd>
        
<br>
				
	<br><br>
		
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'Nome',	'nome',		''),
		array('texto',		'CPF',		'cpf',			''),
		array('texto',		'Celular',			'celular',			''),
		array('resumo',		'E-mail',		'email',			''),
		array('texto',		'Data de Cadastro',		'data1',			''),
	);


	# Consulta SQL
	$SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM user WHERE musculacao LIKE '%$musculacao%'
	
								AND	nome LIKE '%$nome%'
							    AND sobrenome LIKE '%$sobrenome%'
								AND cpf LIKE '%$cpf%'
								AND estadocivil LIKE '%$estadocivil%'
								AND endereco LIKE '%$endereco%'
								AND email LIKE '%$email%'
								AND data LIKE '%$data%'
								
   AND abdominal LIKE '%$abdominal%'
   AND alongamento LIKE '%$alongamento%'
   AND boxe LIKE '%$boxe%'
   AND gap LIKE '%$gap%'
   AND danca LIKE '%$danca%'
   AND jump LIKE '%$jump%'
   AND loca LIKE '%$loca%'
   AND pilates LIKE '%$pilates%'
   AND running LIKE '%$running%'
   AND spinning LIKE '%$spinning%'
   AND step LIKE '%$step%'
   AND tae LIKE '%$tae%'
   AND yoga LIKE '%$yoga%'
   AND outros LIKE '%$outros%'
   AND batack LIKE '%$batack%'
   AND bcombat LIKE '%$bcombat%'
   AND bjam LIKE '%$bjam%'
   AND bpump LIKE '%$bpump%'
   AND powerj LIKE '%$powerj%'
   AND powerp LIKE '%$powerp%'
   AND powerb LIKE '%$powerb%'
   AND powers LIKE '%$powers%'
   AND hbike LIKE '%$hbike%'
   AND hgestante LIKE '%$hgestante%'
   AND hginastica LIKE '%$hginastica%'
   AND hjump LIKE '%$hjump%'
   AND hterapia LIKE '%$hterapia%'
   AND natacao LIKE '%$natacao%'
   AND nbebe LIKE '%$nbebe%'
   AND ninfantil LIKE '%$ninfantil%'
   AND afisica LIKE '%$afisica%'
   AND ptrainer LIKE '%$ptrainer%'
   AND oassessorias LIKE '%$oassessorias%'
   AND odanca LIKE '%$odanca%'
   AND oescolar LIKE '%$oescolar%'
   AND ofutebol LIKE '%$ofutebol%'
   AND oesportes LIKE '%$oesportes%'
   AND olaboral LIKE '%$olaboral%'
   AND oluta LIKE '%$oluta%'
   AND orecreacao LIKE '%$orecreacao%'
   AND musculacao2 LIKE '%$musculacao2%'
   AND abdominal2 LIKE '%$abdominal2%'
   AND alongamento2 LIKE '%$alongamento2%'
   AND boxe2 LIKE '%$boxe2%'
   AND gap2 LIKE '%$gap2%'
   AND danca2 LIKE '%$danca2%'
   AND jump2 LIKE '%$jump2%'
   AND loca2 LIKE '%$loca2%'
   AND pilates2 LIKE '%$pilates2%'
   AND running2 LIKE '%$running2%'
   AND spinning2 LIKE '%$spinning2%'
   AND step2 LIKE '%$step2%'
   AND tae2 LIKE '%$tae2%'
   AND yoga2 LIKE '%$yoga2%'
   AND outros2 LIKE '%$outros2%'
   AND batack2 LIKE '%$batack2%'
   AND bcombat2 LIKE '%$bcombat2%'
   AND bjam2 LIKE '%$bjam2%'
   AND bpump2 LIKE '%$bpump2%'
   AND powerj2 LIKE '%$powerj2%'
   AND powerp2 LIKE '%$powerp2%'
   AND powerb2 LIKE '%$powerb2%'
   AND powers2 LIKE '%$powers2%'
   AND hbike2 LIKE '%$hbike2%'
   AND hgestante2 LIKE '%$hgestante2%'
   AND hginastica2 LIKE '%$hginastica2%'
   AND hjump2 LIKE '%$hjump2%'
   AND hterapia2 LIKE '%$hterapia2%'
   AND natacao2 LIKE '%$natacao2%'
   AND nbebe2 LIKE '%$nbebe2%'
   AND ninfantil2 LIKE '%$ninfantil2%'
   AND afisica2 LIKE '%$afisica2%'
   AND ptrainer2 LIKE '%$ptrainer2%'
   AND oassessorias2 LIKE '%$oassessorias2%'
   AND odanca2 LIKE '%$odanca2%'
   AND oescolar2 LIKE '%$oescolar2%'
   AND ofutebol2 LIKE '%$ofutebol2%'
   AND oesportes2 LIKE '%$oesportes2%'
   AND olaboral2 LIKE '%$olaboral2%'
   AND oluta2 LIKE '%$oluta2%'
   AND orecreacao2 LIKE '%$orecreacao2%'
   
   AND gerencia1 LIKE '%$gerencia1%'
   AND gerencia2 LIKE '%$gerencia2%'
   AND gerencia3 LIKE '%$gerencia3%'
   AND gerencia4 LIKE '%$gerencia4%'
   AND gerencia5 LIKE '%$gerencia5%'
   
   
   AND avaliacaofisica LIKE '%$avaliacaofisica%'   
   AND avaliacaofisica2 LIKE '%$avaliacaofisica2%'
   
   AND personaltrainer LIKE '%$personaltrainer%'
   AND personaltrainer2 LIKE '%$personaltrainer2%'
   
   AND estagiario LIKE '%$estagiario%'
   AND profissional LIKE '%$profissional%'
   
   AND ensinomedio LIKE '%$ensinomedio%'
   AND superior LIKE '%$superior%'
								ORDER BY nome ASC";


	# Processando os dados
	$Lista = new Consulta($SQL,50,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar','visualizar'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>