<? 
	include ('../includes/BancoDeDados.php'); 
	include ('../includes/Funcoes.php'); 
	include ('../includes/Config.php'); 
	include ('../includes/Validacoes.php'); 

	// Post -> $var
	foreach ($_POST as $campo => $valor) $$campo = $valor; 


	// Testes
	$erro=false;
	if (strlen($nome) < 4) $erro=true;
	if (ValidaEmail($email)==false) $erro=true;
	if (strlen($mensagem) < 4) $erro=true;

	// Se houver erro, SAI
	if ($erro==true) { header('Location: ../site/index.php?p=contato&ok=0',true); exit; } 


	// Corpo da mensagem a ser enviada
	$corpo_msg = '<style type="text/css"> body { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; }</style>
	<h4>:: Formulário Contato ::</h4>
	Nome: '.$nome.'<br />
	E-mail: '.$email.'<br />
	Assunto: '.$assunto.'<br />
	Mensagem: <br />
	'.$mensagem;

	$cabecalho = "FROM:".$_POST["nome"]."<".$_POST["email"].">\ncontent-type: text/html; charset=iso-8859-1\nContent-Transfer-Encoding: quoted-printable\nX-priority: 1\n";
	$assunto = "Emprega Fitness - Contato de ".strtoupper($_POST["nome"]);

	// Enviar (CONF_EMAIL está em /includes/Config.php)
	mail(CONF_EMAIL,$assunto,$corpo_msg,$cabecalho);


	// Retorna
	header('Location: ../site/index.php?p=contato&ok=1',true);

?>