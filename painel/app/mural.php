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
	
	$_SESSION['contatoConfirmacao']='';

	// Se houver erro, SAI
	if ($erro==true) { header('Location: ../site/index.php?p=mural&ok=0',true); exit; } 

	//DADOS
	$dados = array('id_mural'=>'', 'nome'=>htmlentities($nome), 'mensagem'=>htmlentities($mensagem), 'email'=>$email, 'flag_status'=>'0', 'datahora'=>'now()');

	db_executa('tbmural', $dados);
	$_SESSION['contatoConfirmacao']='';
	
	// Retorna
	header('Location: ../site/index.php?p=mural&ok=1',true);

?>