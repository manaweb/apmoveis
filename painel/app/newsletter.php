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
	if (validaEmail($email)==false) $erro=true;
	$ExisteEmail = db_linhas(db_consulta("SELECT email FROM tbnewsletter WHERE email LIKE '".trim($email)."'"));
	if ($ExisteEmail>0) $erro=true;


	// Se houver erro, SAI
	if ($erro==true) { header('Location: ../site/index.php?newsletter=0',true); exit; } 


	//DADOS
	$dados = array('nome'=>$nome, 'email'=>trim($email));


	// Executando dados
	db_executa('tbnewsletter', $dados);
		

	// Retorna
	header('Location: ../site/index.php?newsletter=1',true);

?>