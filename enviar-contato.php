<?php
	include 'orcamento/checkout/actioncheckout.class.php';
	$nome = $_GET['nome'];
	$email = $_GET['email'];
	$telefone = $_GET['telefone'];
	$assunto = $_GET['assunto'];
	$mensagem = $_GET['mensagem'];

	$msg = "<html><body>";
	$msg .= "<br><strong><font face= verdana size=2 color=#003366 >Nome: </strong> $nome</font>";
	$msg .= "<br><strong><font face= verdana size=2>E-mail:</strong>  $email</font>";
	$msg.= "<br><strong><font face= verdana size=2>Telefone:</strong>  $telefone</font>";
	$msg .= "<br> <strong><font face= verdana size=2>Assunto:</strong> $assunto</font>";
	$msg .= "<br> <strong><font face= verdana size=2>Mensagem:</strong> $mensagem</font>";
	$msg .= "</body></html>";


	$opts = array(
			
		'assunto' => 'Contato - AP Móveis',
		'remetente' => 'contato@lojaapmoveis.com.br',
		'nomeRemetente' => utf8_decode('AP Móveis'),
		'destino' => array('Cliente' => $email, 'AP Móveis' => 'contato@lojaapmoveis.com.br'),
		'corpo' => $msg
	
	);
	$Act = new ActionCheckout;
	echo $Act->sendConfirm($opts);
?>