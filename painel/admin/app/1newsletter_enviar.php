<? 
	define('ID_MODULO',0,true);
	include('../includes/Config.php');
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	

	# Testes
	$Erros='';
	if (! (strlen($assunto)>0))  $Erros .= "Assunto";
	if (! (strlen($mensagem)>0)) $Erros .= "Mensagem";


	# Se houver erro, SAI
	if (strlen($Erros)>0) { header('Location: ../sys/newsletter_enviar.php?erro='.urlencode($Erros),true); exit; }



	include('../includes/Topo.php'); 
?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="newsletter.php">Newsletter</a> &rsaquo; Enviar e-mails
</div>
<div id="conteudo">

	<h3>Enviando e-mails...</h3><br /><br />
<?
	$Cabecalho = "FROM:Prima Verao<comercial@primaverao.com.br>\ncontent-type: text/html; charset=UTF-8\nContent-Transfer-Encoding: quoted-printable\nX-priority: 0\n";
	$Mensagem = $mensagem;

	$i=0;
	$Emails = db_consulta("SELECT * FROM tbnewsletter ORDER BY nome ASC");
	while ($Email = db_lista($Emails)) { $i++;
		$i1=$i; while (strlen($i1)<5) $i1 = '0'.$i1;

		$Msg = str_replace('{email}',$Email['email'],str_replace('{nome}',$Email['nome'],$Mensagem));
		$Assunto = str_replace('{email}',$Email['email'],str_replace('{nome}',$Email['nome'],$assunto));

		#die($Msg);

		$Enviado = @mail($Email['email'],$Assunto,$Msg,$Cabecalho);
		if ($Enviado) {

			echo $i1." - " . $Email['email'] . " (".$Email['nome'].") - <font color=green><b>OK</b></font><br>\n";

		} else echo $i1." - " . $Email['email'] . " (".$Email['nome'].") - <font color=red><b>ERRO</b></font><br>\n";

	}


?>
	<br /><br /><h3>Fim do processo.</h3>
    <br /><br />

</div>
<?
	include('../includes/Rodape.php');
?>