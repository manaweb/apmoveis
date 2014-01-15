<? 
	define('ID_MODULO',0,true);
	include('../includes/Config.php');
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	
	# Testes
	$Erros='';
 
	$mensagem=utf8_decode($mensagem);

	# Se houver erro, SAI
	if (strlen($Erros)>0) { header('Location: ../sys/newsletter_enviar.php?erro='.urlencode($Erros),true); exit; }



	include('../includes/Topo.php'); 
?>
                	<div class="conthead">
                        <h2>Enviar Newsletter </h2>
                    </div>
<div id="conteudo">

	<h3>Enviando e-mails...</h3><br /><br />
	

<?
	
	$Mensagem = $mensagem;
	$Dequem = $dequem;
	$Nomede = $nomede;

	$i=0;
	$Emails = db_consulta("SELECT * FROM user ORDER BY nome ASC");
	while ($Email = db_lista($Emails)) { $i++;
		$i1=$i; while (strlen($i1)<5) $i1 = '0'.$i1;

		$Msg = str_replace('{email}',$Email['email'],str_replace('{nome}',$Email['nome'],$Mensagem));
		$Assunto = str_replace('{email}',$Email['email'],str_replace('{nome}',$Email['nome'],$assunto));


		$mail             = new PHPMailer(); // defaults to using php "mail()"
		$body             = $Msg;
		$body             = eregi_replace("[\]",'',$body);
		$mail->From       = $Dequem;
		$mail->FromName   = $Nomede;
		$mail->Subject    = $Assunto;
		#$mail->AltBody    = strip_tags($Msg); // optional, comment out and test
		$mail->MsgHTML($body);
		$mail->AddAddress($Email['email'], $Email['nome']);
		#die($body);
		#$mail->AddAttachment("images/phpmailer.gif");             // attachment
		if(!$mail->Send()) {
			echo $i1." - " . $Email['email'] . " (".$Email['nome'].") - <font color=red><b>Falhou (".$mail->ErrorInfo.")</b></font><br>\n";
		} else {
			echo $i1." - " . $Email['email'] . " (".$Email['nome'].") - <font color=green><b>Enviado</b></font><br>\n";
		}
		#if(!$mail->Send()) {
		#  echo "Mailer Error: " . $mail->ErrorInfo;
		#} else {
		#  echo "Message sent!";
		#}
	
	

	}


?>
	<br /><br /><h3>E-mails enviados</h3>
	<a href="../sys">Clique aqui para continuar administrando seu site.</a> 
    <br /><br />

</div>
<?
	include('../includes/Rodape.php');
?>